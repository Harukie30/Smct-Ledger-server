<?php

namespace Database\Seeders;

use App\Enums\RoleNames;
use App\Enums\TempPass;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class OtherUserSeeder extends Seeder
{
    private const CHUNK_SIZE = 500;

    public function run(): void
    {
        $users = collect(require database_path(
            'seeders/data/users.php'
        ));

        if ($users->isEmpty()) {
            $this->command?->warn('No users found to seed.');

            return;
        }

        $this->validateUsers($users);

        $now = now();

        // Hash the shared temporary password only once.
        $password = Hash::make(TempPass::TEMPPASS->value);

        $users = $users->map(fn (array $user) => [
            ...$user,
            'password' => $password,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::transaction(function () use ($users): void {
            // Insert new users and update existing users by email.
            $users->chunk(self::CHUNK_SIZE)->each(
                function (Collection $batch): void {
                    DB::table('users')->upsert(
                        $batch->all(),
                        ['email'],
                        [
                            'name',
                            'code',
                            'branch_code',
                            'updated_at',
                        ]
                    );
                }
            );

            $role = DB::table('roles')
                ->where('name', RoleNames::EMPLOYEE->value)
                ->where('guard_name', 'web')
                ->first();

            if (! $role) {
                throw new RuntimeException(
                    'EMPLOYEE role not found for the web guard. '
                    . 'Run the role seeder first.'
                );
            }

            // Retrieve the IDs of all seeded users.
            $emails = $users->pluck('email');

            User::query()
                ->whereIn('email', $emails)
                ->select('id')
                ->chunkById(
                    self::CHUNK_SIZE,
                    function (Collection $batch) use ($role): void {
                        $now = now();

                        $roleAssignments = $batch->map(
                            fn (User $user) => [
                                'role_id' => $role->id,
                                'model_type' => (new User())->getMorphClass(),
                                'model_id' => $user->id,
                            ]
                        )->all();

                        DB::table('model_has_roles')
                            ->insertOrIgnore($roleAssignments);
                    }
                );
        });

        $this->command?->info(
            "Successfully processed {$users->count()} users."
        );
    }

    /**
     * Validate the input data before writing to the database.
     */
    private function validateUsers(Collection $users): void
    {
        $requiredFields = [
            'name',
            'code',
            'email',
            'branch_code',
        ];

        foreach ($users as $index => $user) {
            foreach ($requiredFields as $field) {
                if (
                    ! isset($user[$field])
                    || trim((string) $user[$field]) === ''
                ) {
                    throw new RuntimeException(
                        "Missing or empty [{$field}] "
                        . "for user record at index {$index}."
                    );
                }
            }
        }

        if ($users->pluck('email')->duplicates()->isNotEmpty()) {
            throw new RuntimeException(
                'Duplicate email addresses found.'
            );
        }
    }
}
