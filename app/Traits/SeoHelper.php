<?php


namespace App\Traits;


use App\Models\Setting;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;

trait SeoHelper
{
    public function setIndexSeo(){
        $title = Setting::where('key' , 'titleSeo')->pluck('value')->first() ?:'' ;
        $name = Setting::where('key' , 'name')->pluck('value')->first() ?:'' ;
        $shortActivity = Setting::where('key' , 'aboutSeo')->pluck('value')->first() ?:'' ;
        $keyword = Setting::where('key' , 'keyword')->pluck('value')->first() ?: [] ;
        if ($keyword){
            $keywordFinal = explode(',' , $keyword) ;
        }else{
            $keywordFinal = [];
        }
        $logoSite = Setting::where('key' , 'logo')->pluck('value')->first() ?:'' ;
        SEOTools::setDescription($shortActivity);
        SEOTools::opengraph()->setUrl(url(''));
        SEOTools::setCanonical(url(''));
        SEOMeta::addKeyword($keywordFinal);
        SEOTools::opengraph()->addProperty('type', 'company');
        //twitter
        SEOTools::twitter()->setSite($title);
        SEOTools::twitter()->setDescription($shortActivity);
        SEOTools::twitter()->setTitle($title);
        SEOTools::twitter()->setImage(url($logoSite));
        SEOTools::twitter()->addValue('image:alt' , $title);
        SEOTools::twitter()->addValue('card' , 'summary');
        SEOTools::jsonLd()->addImage(url($logoSite));
        SEOTools::jsonLd()->setTitle($title);
        SEOTools::jsonLd()->setDescription($shortActivity);
        SEOTools::jsonLd()->setType('company');
        SEOTools::jsonLd()->addValues([
            'url' => url(''),
            'potentialAction' => [
                '@type' => "SearchAction",
                'target' => url("search?search={search}"),
                'query-input' => "required name=search"
            ]
        ]);
        //OpenGraph
        OpenGraph::addProperty('locale', 'fa');
        OpenGraph::setSiteName($name);
        OpenGraph::addImage(url($logoSite));
        OpenGraph::setTitle($title); // define title
        OpenGraph::setDescription($shortActivity);  // define description
        OpenGraph::setUrl(url('')); // define url

        JsonLd::setTitle($title);
        JsonLd::setDescription($shortActivity);
        JsonLd::setType('company');
        JsonLd::addImage(url($logoSite));

        JsonLdMulti::setTitle($title);
        JsonLdMulti::setDescription($shortActivity);
        JsonLdMulti::setType('company');
        JsonLdMulti::addImage(url($logoSite));
    }

    public function seoSingleSeo($title , $description , $type , $url , $image,$keyword){
        $titleSite = Setting::where('key' , 'titleSeo')->pluck('value')->first() ?:'' ;
        $urlSite = Setting::where('key' , 'address')->pluck('value')->first() ?:'' ;
        if ($keyword){
            $keywordFinal = explode(',' , $keyword) ;
        }else{
            $keywordFinal = [];
        }
        $name = Setting::where('key' , 'name')->pluck('value')->first() ?:'' ;
        SEOTools::opengraph()->setUrl(url($url));
        SEOTools::setCanonical(url($url));
        SEOTools::setDescription($description);
        SEOMeta::addKeyword($keywordFinal);
        SEOTools::opengraph()->addProperty('type', $type);
        //twitter
        SEOTools::twitter()->setSite($titleSite);
        SEOTools::twitter()->setDescription($description);
        SEOTools::twitter()->setTitle($title);
        SEOTools::jsonLd()->addImage(url($image));
        SEOTools::jsonLd()->setTitle($title);
        SEOTools::jsonLd()->setDescription($description);
        SEOTools::jsonLd()->setType($type);
        SEOTools::twitter()->setImage(url($image));
        //OpenGraph
        OpenGraph::addProperty('locale', 'fa');
        OpenGraph::setSiteName($name);
        OpenGraph::addImage(url($image));
        OpenGraph::setTitle($title); // define title
        OpenGraph::setDescription($description);  // define description
        OpenGraph::setUrl(url( $url)); // define url

        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setType($type);
        JsonLd::addImage(url($image));

        JsonLdMulti::setTitle($title);
        JsonLdMulti::setDescription($description);
        JsonLdMulti::setType($type);
        JsonLdMulti::addImage(url($image));
    }
}
