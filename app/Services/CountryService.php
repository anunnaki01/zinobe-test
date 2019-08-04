<?php
/**
 * Created by PhpStorm.
 * User: juan
 * Date: 3/08/19
 * Time: 02:51 PM
 */

namespace App\Services;

class CountryService
{
    protected $url = 'https://pkgstore.datahub.io/core/country-list/data_json/data/8c458f2d15d9f2119654b29ede6e45b8/data_json.json';

    /**
     * hace el llamado para obtener los paises
     * @return array
     */
    public function get(): array
    {
        exec("curl {$this->url}", $output);

        if (empty($output[0])) {
            return [];
        }

        return json_decode($output[0], true);
    }
}