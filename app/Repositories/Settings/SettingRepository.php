<?php


namespace App\Repositories\Settings;


use App\Models\Settings;
use App\Models\Socialmedia;
use App\Repositories\BaseRepository;

class SettingRepository extends BaseRepository
{
    public function __construct(Settings $model) {
        parent::__construct($model);
        $this->model = $model;
    }

    public function updateSetting(array $params){

        $collection = collect($params)->except('_token', 'logo', 'favicon');

        $setting = Settings::first()->fill($collection->all());
        return ($setting->update())?$setting:false;

    }

    public function updateSocialMedia(array $params){
        $collection = collect($params)->except('_token');

        $socialMedia = Socialmedia::first()->fill($collection->all());
        return ($socialMedia->update())?$socialMedia:FALSE;
    }

}
