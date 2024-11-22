<?php

namespace App\Http\Controllers\Web\Admin;

use App\Base\Filters\Master\CommonMasterFilter;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use App\Models\Country;
use App\Http\Requests\Admin\Country\CreateCountryRequest;
use App\Http\Controllers\Web\BaseController;
use App\Models\Language;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Base\Services\ImageUploader\ImageUploaderContract;
use App\Transformers\CountryTransformer;
use App\Transformers\CountryTranslationTransformer;
use Illuminate\Http\Request;

class CountryController extends BaseController
{
    protected $country;

    /**
     * countryController constructor.
     *
     * @param \App\Models\Admin\Country $country
     */
    public function __construct(Country $country, ImageUploaderContract $imageUploader)
    {
        $this->country = $country;
        $this->imageUploader = $imageUploader;
    }

    public function index()
    {
        $page = trans('pages_names.view_country');

        $main_menu = 'settings';
        $sub_menu = 'country';

        return view('admin.country.index', compact('page', 'main_menu', 'sub_menu'));
    }

    public function fetch(QueryFilterContract $queryFilter)
    {
        $query = Country::query();

        $results = $queryFilter->builder($query)->customFilter(new CommonMasterFilter)->paginate();

        $items = json_decode(fractal($results->items(), new CountryTransformer)->parseIncludes(['countryTranslationDetail'])->toJson());
        $results->setCollection(collect($items->data));

        return view('admin.country._country', compact('results'));
    }

    public function create()
    {
        $page = trans('pages_names.add_country');
        $main_menu = 'settings';
        $sub_menu = 'country';

        $locale = App::getLocale();
        $langcode = \DB::table('ltm_translations')->groupBy('locale')->pluck('locale');
        $lang_data = DB::table('ltm_translations')->whereIn('locale',$langcode)->groupBy('locale')->get();

        return view('admin.country.create', compact( 'page', 'main_menu', 'lang_data', 'sub_menu'));
    }

    public function store(CreateCountryRequest $request)
    {
        $created_params = $request->only([
        'dial_code',
        'code',
        'active',
        'currency_name',
        'currency_code',
        'currency_symbol',
        'dial_min_length',
        'dial_max_length']);
        $created_params['active'] = 1;
        $created_params['name'] = $request->name_en;


        if ($uploadedFile = $this->getValidatedUpload('flag', $request)) {
            $created_params['flag'] = $this->imageUploader->file($uploadedFile)
                ->saveCountryFlagImage();
        }
        $this->country->create($created_params);

        foreach ($lang_data as $k => $translation) {
            if($request->has('name_'.$translation->locale) && $request->input('name_'.$translation->locale))
            {
                $country->countryTranslationDetail()->create([
                    'name' => $request->input('name_'.$translation->locale),
                    'locale' => $translation->locale,
                ]);
            }
        }
        $message = trans('succes_messages.country_added_succesfully');

        return redirect('country')->with('success', $message);
    }

    public function getById(Country $country)
    {
        $page = trans('pages_names.edit_country');
        $main_menu = 'settings';
        $sub_menu = 'country';
        $item = $country;

        $countryTranslations = fractal($item->countryTranslationDetail, new CountryTranslationTransformer)->parseIncludes(['countryTranslationDetail'])->toArray();
        $locale = App::getLocale();
        $langcode = \DB::table('ltm_translations')->groupBy('locale')->pluck('locale');
        $lang_data = DB::table('ltm_translations')->whereIn('locale',$langcode)->groupBy('locale')->get();

        $translations = [];
        foreach ($countryTranslations['data'] as $key => $translation) {
            $translations[$translation['locale']] = $translation['name'];
        }
        $item ->translation = $translations;

        return view('admin.country.update', compact( 'item', 'page','lang_data', 'main_menu', 'sub_menu'));
    }

    public function update(CreateCountryRequest $request, Country $country)
    {

        $updated_params = $request->only([
            'dial_code',
            'code',
            'active',
            'currency_name',
            'currency_code',
            'currency_symbol',
            'dial_min_length',
            'dial_max_length'
        ]);

        $created_params['name'] = $request->name_en;


        $langcode = ['en','ar'];
        $lang_data = DB::table('ltm_translations')->whereIn('locale',$langcode)->groupBy('locale')->get();
        $country->countryTranslationDetail()->delete();

        foreach ($lang_data as $k => $translation) {
            if($request->has('name_'.$translation->locale) && $request->input('name_'.$translation->locale))
            {
                $country->countryTranslationDetail()->create([
                    'name' => $request->input('name_'.$translation->locale),
                    'locale' => $translation->locale,
                ]);
            }
        }
        if ($uploadedFile = $this->getValidatedUpload('flag', $request)) {
            $updated_params['flag'] = $this->imageUploader->file($uploadedFile)
                ->saveCountryFlagImage();
        }
        $country->update($updated_params);
        $message = trans('succes_messages.country_updated_succesfully');
        return redirect('country')->with('success', $message);
    }

    public function toggleStatus(Country $country)
    {
        $status = $country->isActive() ? false: true;
        $country->update(['active' => $status]);

        $message = trans('succes_messages.country_status_changed_succesfully');
        return redirect('country')->with('success', $message);
    }

    public function delete(Country $country)
    {
        $country->delete();

        $message = trans('succes_messages.country_deleted_succesfully');
        return redirect('country')->with('success', $message);
    }
}
