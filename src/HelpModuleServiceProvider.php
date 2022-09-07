<?php

namespace HelpModule\HelpModule;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use HelpModule\HelpModule\Commands\HelpModuleCommand;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Models\HelpingList;
use Illuminate\Http\Request;
class HelpModuleServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('help-module')
            ->hasViews()
            ->hasMigration('create_help-module_table');
            
    }
    public function boot()
    {
        View::composer('*', function ($view) {
            
            
            $currentURL=  url()->full();
            $helptext = "";
            $contains = Str::contains($currentURL, 'help=technical');
            if($contains)
            {
                //storing the substring before the query string in $slice	
                $slice = substr($currentURL, 0, strpos($currentURL, '&help=technical'));
                
            //fetching the records from the database
    
                $urls = HelpingList::where('page_url', $slice)->where('status','1')->first();
                

             if(empty($urls)){

                $slice = substr($currentURL, 0, strpos($currentURL, '?'));
    
                //HelpingList is the model  we will match the url.

                $urls = HelpingList::where('page_url', $slice)->where('status','1')->first();
                
             }

            }
            else{
                $urls="";
                $currenturl= url()->current();
             
                $helptext = HelpingList::where('page_url', $currenturl)->where('status','1')->first();
                
            }

            $view->with('urls', $urls)->with('helpurl',$helptext);

        });
    }
}
