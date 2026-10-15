<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\RoleNames;
use App\Enums\TempPass;
use App\Models\User;
use Illuminate\Database\Seeder;

class OtherUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
                    [
                        "name"          => "SMCT Molave",
                        "code"          => "MOLS",
                        "email"         => "mols@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Turno",
                        "code"          => "SDIP",
                        "email"         => "sdip@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Aklan",
                        "code"          => "AKLA",
                        "email"         => "akla@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Antique",
                        "code"          => "ANTI",
                        "email"         => "anti@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Argao",
                        "code"          => "SARG",
                        "email"         => "sarg@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Bantayan",
                        "code"          => "BANTA",
                        "email"         => "banta@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Baybay",
                        "code"          => "BAYB",
                        "email"         => "bayb@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Binan",
                        "code"          => "BINAN",
                        "email"         => "binan@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Calape 2",
                        "code"          => "CALAP2",
                        "email"         => "calap2@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Carcar",
                        "code"          => "CARS",
                        "email"         => "cars@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Carmen",
                        "code"          => "CARMB",
                        "email"         => "carmb@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Carmona",
                        "code"          => "CARMO",
                        "email"         => "carmo@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Catarman",
                        "code"          => "CATAR",
                        "email"         => "catar@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Dasmariñas",
                        "code"          => "DASMA",
                        "email"         => "dasma@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Famy",
                        "code"          => "FAMY",
                        "email"         => "famy@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Guindulman",
                        "code"          => "GUIN",
                        "email"         => "guin@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Guindulman 2",
                        "code"          => "GUIN2",
                        "email"         => "guin2@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Jagna",
                        "code"          => "JAGN",
                        "email"         => "jagn@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Lapu-Lapu",
                        "code"          => "SLAP",
                        "email"         => "slap@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Liloan",
                        "code"          => "SLIL",
                        "email"         => "slil@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Lipa",
                        "code"          => "LIPA",
                        "email"         => "lipa@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Loay",
                        "code"          => "LOAY",
                        "email"         => "loay@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Logistics",
                        "code"          => "CAGL",
                        "email"         => "cagl@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Logistics 2",
                        "code"          => "DIPL",
                        "email"         => "dipl@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Logistics 3",
                        "code"          => "OZAL",
                        "email"         => "ozal@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Logistics 4",
                        "code"          => "ZAML",
                        "email"         => "zaml@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Logistics Mandaue",
                        "code"          => "MANL",
                        "email"         => "manl@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Madridejos",
                        "code"          => "MADRI",
                        "email"         => "madri@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Manga",
                        "code"          => "MANG",
                        "email"         => "mang@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Naic",
                        "code"          => "NAIC",
                        "email"         => "naic@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Pagsanjan",
                        "code"          => "PAGS",
                        "email"         => "pags@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Rosario",
                        "code"          => "SROS",
                        "email"         => "sros@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Sagbayan",
                        "code"          => "SAGBA",
                        "email"         => "sagba@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT San Jose",
                        "code"          => "SANJ",
                        "email"         => "sanj@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT San Pedro",
                        "code"          => "SANP",
                        "email"         => "sanp@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Santander 2",
                        "code"          => "SANT2",
                        "email"         => "sant2@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Silang",
                        "code"          => "SILA",
                        "email"         => "sila@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Talibon",
                        "code"          => "TALI",
                        "email"         => "tali@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Talibon 2",
                        "code"          => "TALI2",
                        "email"         => "tali2@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Tanza",
                        "code"          => "TANZ",
                        "email"         => "tanz@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Tanza 2",
                        "code"          => "TANZ2",
                        "email"         => "tanz2@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Trinidad",
                        "code"          => "TRINI",
                        "email"         => "trini@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Trinidad 2",
                        "code"          => "TRINI2",
                        "email"         => "trini2@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Tubigon",
                        "code"          => "TUBI",
                        "email"         => "tubi@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Valencia",
                        "code"          => "VALEN",
                        "email"         => "valen@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Yati Liloan",
                        "code"          => "YATI",
                        "email"         => "yati@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Property Ventures Corporation",
                        "code"          => "SPVC",
                        "email"         => "spvc@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Loon",
                        "code"          => "LOON",
                        "email"         => "loon@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Abuyog",
                        "code"          => "ABUY",
                        "email"         => "abuy@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Panabo",
                        "code"          => "DSMPO",
                        "email"         => "dsmpo@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Rizal Pagadian",
                        "code"          => "RIZA",
                        "email"         => "riza@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Santo Tomas",
                        "code"          => "TOMAS",
                        "email"         => "tomas@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Suzuki Ozamiz",
                        "code"          => "DSMSO",
                        "email"         => "dsmso@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Tacurong",
                        "code"          => "TACU",
                        "email"         => "tacu@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Tagbilaran",
                        "code"          => "DSMT",
                        "email"         => "dsmt@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Tagum",
                        "code"          => "DSMTG",
                        "email"         => "dsmtg@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Toril",
                        "code"          => "TORI",
                        "email"         => "tori@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Valencia",
                        "code"          => "DSMV",
                        "email"         => "dsmv@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Villanueva",
                        "code"          => "VILLA",
                        "email"         => "villa@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Argao",
                        "code"          => "DSMAO",
                        "email"         => "dsmao@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Balamban",
                        "code"          => "DSMBN",
                        "email"         => "dsmbn@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Basak",
                        "code"          => "DSMB",
                        "email"         => "dsmb@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Bogo Multi",
                        "code"          => "BOGO",
                        "email"         => "bogo@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Calinog Y3s",
                        "code"          => "CALIN",
                        "email"         => "calin@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Cambaro",
                        "code"          => "DSMA",
                        "email"         => "dsma@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Carcar",
                        "code"          => "CARC",
                        "email"         => "carc@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Carcar 2",
                        "code"          => "CARC2",
                        "email"         => "carc2@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Carmen",
                        "code"          => "DSMDN",
                        "email"         => "dsmdn@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Carmen 2",
                        "code"          => "CARMC2",
                        "email"         => "carmc2@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Catmon",
                        "code"          => "DSMCN",
                        "email"         => "dsmcn@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Compostela",
                        "code"          => "COMPO",
                        "email"         => "compo@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Consolacion",
                        "code"          => "DSMP",
                        "email"         => "dsmp@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Daanbantayan 2",
                        "code"          => "DAAN",
                        "email"         => "daan@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Danao",
                        "code"          => "DANAO",
                        "email"         => "danao@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Iloilo",
                        "code"          => "ILOI",
                        "email"         => "iloi@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Labangon",
                        "code"          => "DSMK",
                        "email"         => "dsmk@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Lapu-Lapu 2",
                        "code"          => "LAPU",
                        "email"         => "lapu@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Liloan",
                        "code"          => "DSMLN",
                        "email"         => "dsmln@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Mandaue Multi",
                        "code"          => "MAND",
                        "email"         => "mand@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Mandaue Y3s",
                        "code"          => "MAND2",
                        "email"         => "mand2@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Medellin",
                        "code"          => "MEDE",
                        "email"         => "mede@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Pardo",
                        "code"          => "PARD",
                        "email"         => "pard@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Pardo 2 Suzuki 3s",
                        "code"          => "PARD2",
                        "email"         => "pard2@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM San Remigio",
                        "code"          => "REMI",
                        "email"         => "remi@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM San Remigio 2",
                        "code"          => "REMI2",
                        "email"         => "remi2@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Talamban",
                        "code"          => "DSMTA",
                        "email"         => "dsmta@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Toledo",
                        "code"          => "DSML",
                        "email"         => "dsml@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Toledo 2",
                        "code"          => "DSMDM",
                        "email"         => "dsmdm@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Tuburan",
                        "code"          => "TUBU",
                        "email"         => "tubu@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Ubay",
                        "code"          => "UBAY",
                        "email"         => "ubay@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Bolod",
                        "code"          => "BOLOD",
                        "email"         => "bolod@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Catarman",
                        "code"          => "CATAR2",
                        "email"         => "catar2@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Monkayo",
                        "code"          => "MONKA",
                        "email"         => "monka@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Surplus Car Production",
                        "code"          => "MANP",
                        "email"         => "manp@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Suzuki Auto Bohol",
                        "code"          => "DSMSB",
                        "email"         => "dsmsb@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Nabunturan",
                        "code"          => "NABU",
                        "email"         => "nabu@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Bayugan",
                        "code"          => "BAYU",
                        "email"         => "bayu@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Norzagaray",
                        "code"          => "NORZA",
                        "email"         => "norza@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Tanza 3",
                        "code"          => "TANZ3",
                        "email"         => "tanz3@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Tacloban",
                        "code"          => "UTAP",
                        "email"         => "utap@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Gingoog",
                        "code"          => "GINGO",
                        "email"         => "gingo@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Calbayog",
                        "code"          => "CALB",
                        "email"         => "calb@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Sablayan",
                        "code"          => "SABLA",
                        "email"         => "sabla@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Quezon",
                        "code"          => "QUEZ",
                        "email"         => "quez@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Panglao 3s",
                        "code"          => "PANGL",
                        "email"         => "pangl@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Kabacan",
                        "code"          => "KABAC",
                        "email"         => "kabac@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Isulan",
                        "code"          => "ISU",
                        "email"         => "isu@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Butuan",
                        "code"          => "BUTU",
                        "email"         => "butu@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Toledo Y3s",
                        "code"          => "TOLED",
                        "email"         => "toled@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Asturias",
                        "code"          => "ASTUR",
                        "email"         => "astur@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Santa",
                        "code"          => "SANTA",
                        "email"         => "santa@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Suzuki Auto Iligan",
                        "code"          => "DSMSI",
                        "email"         => "dsmsi@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Balasan",
                        "code"          => "BALAS",
                        "email"         => "balas@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Kibawe",
                        "code"          => "KIBA",
                        "email"         => "kiba@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM General Maxilom",
                        "code"          => "GENMAX",
                        "email"         => "genmax@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Kiba Landscape",
                        "code"          => "KIBAL",
                        "email"         => "kibal@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Buenavista",
                        "code"          => "BUEN",
                        "email"         => "buen@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Calapan",
                        "code"          => "CALAPM",
                        "email"         => "calapm@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Surigao",
                        "code"          => "GAISA",
                        "email"         => "gaisa@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Cabadbaran",
                        "code"          => "CABA",
                        "email"         => "caba@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Bacolod",
                        "code"          => "BACO",
                        "email"         => "baco@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Pinamalayan",
                        "code"          => "PINA",
                        "email"         => "pina@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Jaro",
                        "code"          => "JARO",
                        "email"         => "jaro@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Victoria",
                        "code"          => "VICTO",
                        "email"         => "victo@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Passi",
                        "code"          => "PASI",
                        "email"         => "pasi@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Alano",
                        "code"          => "ALAH",
                        "email"         => "alah@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Aurora",
                        "code"          => "AURH",
                        "email"         => "aurh@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Buug",
                        "code"          => "BUUH",
                        "email"         => "buuh@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Calamba",
                        "code"          => "CALA",
                        "email"         => "cala@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Camino Nuevo",
                        "code"          => "CAMH",
                        "email"         => "camh@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Datoc",
                        "code"          => "DATH",
                        "email"         => "dath@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD General Trias",
                        "code"          => "GENT",
                        "email"         => "gent@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Gusa",
                        "code"          => "GUSA",
                        "email"         => "gusa@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Initao",
                        "code"          => "INIT",
                        "email"         => "init@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Ipil",
                        "code"          => "IPIH",
                        "email"         => "ipih@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Kabasalan",
                        "code"          => "KABA",
                        "email"         => "kaba@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Maranding",
                        "code"          => "MARH",
                        "email"         => "marh@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Molave",
                        "code"          => "MOLH",
                        "email"         => "molh@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Oroquieta",
                        "code"          => "OROH",
                        "email"         => "oroh@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Oroquieta 2",
                        "code"          => "OROH2",
                        "email"         => "oroh2@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Ozamiz",
                        "code"          => "OZAH",
                        "email"         => "ozah@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Sindangan",
                        "code"          => "SINDA",
                        "email"         => "sinda@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Veterans",
                        "code"          => "VETH",
                        "email"         => "veth@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Villanueva",
                        "code"          => "VILLA2",
                        "email"         => "villa2@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Balamban",
                        "code"          => "BALAM",
                        "email"         => "balam@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Calinog",
                        "code"          => "CALIN2",
                        "email"         => "calin2@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Carmen",
                        "code"          => "CARMC",
                        "email"         => "carmc@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Pardo",
                        "code"          => "PARD3",
                        "email"         => "pard3@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Inabanga",
                        "code"          => "INAB",
                        "email"         => "inab@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Tanza",
                        "code"          => "TANH",
                        "email"         => "tanh@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD San Pablo",
                        "code"          => "SANPA",
                        "email"         => "sanpa@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Sara",
                        "code"          => "SARA",
                        "email"         => "sara@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Rawis",
                        "code"          => "RAWIS",
                        "email"         => "rawis@gmail.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Alano",
                        "code"          => "ALAD",
                        "email"         => "alad@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Aurora",
                        "code"          => "AURD",
                        "email"         => "aurd@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Balingasag",
                        "code"          => "BALD",
                        "email"         => "bald@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Bonifacio",
                        "code"          => "BONI",
                        "email"         => "boni@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Buug",
                        "code"          => "BUUD",
                        "email"         => "buud@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Calamba",
                        "code"          => "CALD",
                        "email"         => "cald@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Camino Nuevo",
                        "code"          => "CAMD",
                        "email"         => "camd@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Dapitan",
                        "code"          => "DAPI",
                        "email"         => "dapi@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Dipolog",
                        "code"          => "DIPD",
                        "email"         => "dipd@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Dipolog 2",
                        "code"          => "DIPD2",
                        "email"         => "dipd2@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Iligan",
                        "code"          => "ILID",
                        "email"         => "ilid@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Imelda 2",
                        "code"          => "IMED2",
                        "email"         => "dap_imelda_2@smctgroup.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Initao",
                        "code"          => "INIT2",
                        "email"         => "init2@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Ipil",
                        "code"          => "IPID",
                        "email"         => "ipid@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Jimenez",
                        "code"          => "JIME",
                        "email"         => "jime@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Kabasalan",
                        "code"          => "KABD",
                        "email"         => "kabd@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Labason",
                        "code"          => "LABD",
                        "email"         => "labd@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Liloy",
                        "code"          => "LILD",
                        "email"         => "lild@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Manolo Fortich",
                        "code"          => "MANO",
                        "email"         => "mano@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Maramag",
                        "code"          => "MARA2",
                        "email"         => "mara2@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Maranding",
                        "code"          => "MARD",
                        "email"         => "mard@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Molave",
                        "code"          => "MOLD",
                        "email"         => "mold@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Molave 2",
                        "code"          => "MOLD2",
                        "email"         => "mold2@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Nuñez",
                        "code"          => "NUND2",
                        "email"         => "nund2@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Oroquieta",
                        "code"          => "OROD",
                        "email"         => "orod@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Ozamiz",
                        "code"          => "OZAD",
                        "email"         => "ozad@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Ozamiz (Rizal)",
                        "code"          => "RIZD",
                        "email"         => "rizd@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Putik",
                        "code"          => "PUTD",
                        "email"         => "putd@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP San Miguel",
                        "code"          => "SANM",
                        "email"         => "sanm@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Sindangan",
                        "code"          => "SIND",
                        "email"         => "sind@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Sucabon",
                        "code"          => "SUCD",
                        "email"         => "sucd@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Tubod",
                        "code"          => "TUBOD",
                        "email"         => "tubod@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Vitali",
                        "code"          => "VITA",
                        "email"         => "vita@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Oroquieta 2",
                        "code"          => "OROD2",
                        "email"         => "orod2@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DAP Bayog",
                        "code"          => "BAYOG",
                        "email"         => "bayog@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "DSM Tagbilaran 2",
                        "code"          => "DSMT2",
                        "email"         => "dsmt2@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "SMCT Alicia",
                        "code"          => "ALIC",
                        "email"         => "alicia@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm Minglanilla",
                        "code"          => "MING",
                        "email"         => "ming@smctgroup.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm San Fernando",
                        "code"          => "SANFER",
                        "email"         => "safer@smctgroup.ph",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm Lahug",
                        "code"          => "LAHUG",
                        "email"         => "lahug@smctgroup.ph",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm-Bayugan",
                        "code"          => "BAYUG",
                        "email"         => "dsmbayugan@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Des Strong Motors, Inc Calbayog",
                        "code"          => "CALBA",
                        "email"         => "dsmcalbayog@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Des Strong Motors Inc-Don Carlos",
                        "code"          => "DONC",
                        "email"         => "dsm.doncarlos@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Hilongos",
                        "code"          => "HILON",
                        "email"         => "hilon@smct.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Bulua 2",
                        "code"          => "BULU",
                        "email"         => "bulu@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Strong Moto Centrum, Inc. Malaybalay",
                        "code"          => "MALA",
                        "email"         => "smct.malaybalay4@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm Dinagat",
                        "code"          => "DINAG",
                        "email"         => "dsmdinagat@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Digos 2",
                        "code"          => "DIGOS2",
                        "email"         => "digos2@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm Gusa",
                        "code"          => "DSMC",
                        "email"         => "dsmcagayan05@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm Carmen Cdo",
                        "code"          => "CARMCDO",
                        "email"         => "dsmcarmencdo2026@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Des Strong Motors Inc. Digos",
                        "code"          => "DIGOS",
                        "email"         => "dsmdigos2025@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm-Iligan",
                        "code"          => "ILIG",
                        "email"         => "dsmiligan2019@yahoo.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Allen",
                        "code"          => "ALEN",
                        "email"         => "alen@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Bulua Yamaha 3S",
                        "code"          => "DSMBL",
                        "email"         => "dsmbl@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm - Matina",
                        "code"          => "MATI",
                        "email"         => "dsm2026matina@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Jimenez",
                        "code"          => "JIMEDSM",
                        "email"         => "jimedsm@gmail.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Calinan",
                        "code"          => "CALI",
                        "email"         => "cali@gmail.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm Kabasalan",
                        "code"          => "KABA2",
                        "email"         => "dsm_kabasalan@smctgroup.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm Dipolog 2",
                        "code"          => "DSMD2",
                        "email"         => "dsm_dipolog_2@smctgroup.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm Aurora",
                        "code"          => "AURO",
                        "email"         => "dsm_aurora@smctgroup.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm Sergio Osmena",
                        "code"          => "SERG",
                        "email"         => "dsm_sergio_osmena@smctgroup.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm Balangasan",
                        "code"          => "BALA",
                        "email"         => "dsm_balangasan@smctgroup.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dap Imelda",
                        "code"          => "IMED",
                        "email"         => "imed@gmail.com",
                        "branch_code"   => "DAP",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Smct Alano",
                        "code"          => "SALA",
                        "email"         => "smct_alano@smctgroup.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm Cerilles",
                        "code"          => "CERI",
                        "email"         => "dsm_cerilles@smctgroup.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm Molave",
                        "code"          => "DSMM",
                        "email"         => "dsm_molave@smctgroup.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm Bayog",
                        "code"          => "BAYO",
                        "email"         => "dsm_bayog@smctgroup.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm Labason",
                        "code"          => "LABA",
                        "email"         => "dsm_labason@smctgroup.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm Dipolog 1",
                        "code"          => "DSMD",
                        "email"         => "dsm_dipolog_1@smctgroup.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm Catmon 2",
                        "code"          => "CATM2",
                        "email"         => "dsm_catmon_2@smctgroup.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm Katipunan",
                        "code"          => "KATI",
                        "email"         => "dsm_katipunan@smctgroup.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Hd Catmon",
                        "code"          => "CATMO",
                        "email"         => "hd_catmon@smctgroup.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm Calamba",
                        "code"          => "DSMCA",
                        "email"         => "dsm_calamba@smctgroup.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Antipolo",
                        "code"          => "ANTIP",
                        "email"         => "antipolo@smctgroup.com",
                        "branch_code"   => "SMCT",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Hd Ipil",
                        "code"          => "SMCT",
                        "email"         => "hd_ipil@smctgroup.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm General Maxilom",
                        "code"          => "MAXI",
                        "email"         => "dsm_general_maxilom@smctgroup.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "HD Ayala",
                        "code"          => "AYAL",
                        "email"         => "ayala@smctgroup.com",
                        "branch_code"   => "HD",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm - El Salvador",
                        "code"          => "ELSA",
                        "email"         => "dsm_-_el_salvador@smctgroup.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Dsm - Alcoy",
                        "code"          => "ALCOY",
                        "email"         => "dsm_-_alcoy@smctgroup.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Rena Ranque",
                        "code"          => "RENA",
                        "email"         => "rena_ranque@smctgroup.com",
                        "branch_code"   => "HO",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Jenecil Patac",
                        "code"          => "JENECIL",
                        "email"         => "jenecil_patac@smctgroup.com",
                        "branch_code"   => "HO",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Cristian Simbajon",
                        "code"          => "CRISTIAN",
                        "email"         => "cristian_simbajon@smctgroup.com",
                        "branch_code"   => "HO",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Amadeus Mozart Labao",
                        "code"          => "MOZART",
                        "email"         => "amadeus_mozart_labao@smctgroup.com",
                        "branch_code"   => "HO",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Deby Daplin",
                        "code"          => "DEBY",
                        "email"         => "deby_daplin@smctgroup.com",
                        "branch_code"   => "HO",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Caryl",
                        "code"          => "CARYL",
                        "email"         => "caryl@smctgroup.com",
                        "branch_code"   => "HO",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Karlyn",
                        "code"          => "KARLYN",
                        "email"         => "karlyn@smctgroup.com",
                        "branch_code"   => "HO",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Joselito",
                        "code"          => "JOSELITO",
                        "email"         => "joselito@smctgroup.com",
                        "branch_code"   => "HO",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Repo Hub Bohol",
                        "code"          => "BOHR",
                        "email"         => "repo_hub_bohol@smctgroup.com",
                        "branch_code"   => "DSM",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Smct Audit",
                        "code"          => "AUDIT",
                        "email"         => "smct_audit@smctgroup.com",
                        "branch_code"   => "HO",
                        "password"      =>  TempPass::TEMPPASS->value
                    ],
                    [
                        "name"          => "Smct Accounting",
                        "code"          => "ACCOUNTING",
                        "email"         => "smct_accounting@smctgroup.com",
                        "branch_code"   => "HO",
                        "password"      =>  TempPass::TEMPPASS->value
                    ]
                ];

        collect($users)->each( function ($userData) {
                $user = User::create($userData);
                $user->assignRole(RoleNames::EMPLOYEE->value);
            }
        );

    }
}
