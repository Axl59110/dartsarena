<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Federation;

class FederationSeeder extends Seeder
{
    public function run(): void
    {
        $federations = [
            [
                "name" => [
                    "fr" => "Professional Darts Corporation",
                    "en" => "Professional Darts Corporation",
                ],
                "slug" => "pdc",
                "description" => [
                    "fr" => "La principale organisation professionnelle de fléchettes au monde, organisant les plus grands tournois et accueillant les meilleurs joueurs.",
                    "en" => "The world's leading professional darts organisation, hosting the biggest tournaments and featuring the best players.",
                ],
                "logo_url" => "/images/federations/pdc.png",
                "website_url" => "https://www.pdc.tv",
            ],
            [
                "name" => [
                    "fr" => "World Darts Federation",
                    "en" => "World Darts Federation",
                ],
                "slug" => "wdf",
                "description" => [
                    "fr" => "La fédération mondiale de fléchettes, organisme international régissant le sport des fléchettes à travers le monde.",
                    "en" => "The World Darts Federation, the international governing body for the sport of darts worldwide.",
                ],
                "logo_url" => "/images/federations/wdf.png",
                "website_url" => "https://www.dartswdf.com",
            ],
            [
                "name" => [
                    "fr" => "British Darts Organisation (Legacy)",
                    "en" => "British Darts Organisation (Legacy)",
                ],
                "slug" => "bdo",
                "description" => [
                    "fr" => "L'ancienne organisation britannique de fléchettes, historiquement l'une des plus importantes fédérations avant sa dissolution.",
                    "en" => "The former British darts organisation, historically one of the most important federations before its dissolution.",
                ],
                "logo_url" => "/images/federations/bdo.png",
                "website_url" => null,
            ],
        ];

        foreach ($federations as $federation) {
            Federation::create($federation);
        }
    }
}
