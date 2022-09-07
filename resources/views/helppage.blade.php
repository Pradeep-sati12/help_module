 
@php
use App\Models\HelpingList;
$currentURL=Request::fullUrl();
//to check if the string contains the help=technical
$contains = Str::contains($currentURL, 'help=technical');
//condition if help=technical is present
if($contains)
{
	//storing the substring before the query string in $slice	
	$slice = substr($currentURL, 0, strpos($currentURL, 'help=technical'));
  //fetching the records from the database
    
	$urls = HelpingList::where('page_url', $slice)->first();

	if(empty($urls)){
    //to get the url before the query string 
		$slice = substr($currentURL, 0, strpos($currentURL, '?'));
	
	//HelpingList is the model  we will match the url.

	  $urls = HelpingList::where('page_url', $slice)->first();

    //incase of url matching before the query string
   
      @endphp
      <a href="{{ $urls->functional_video_url }}"><button>Functional video url </button></a>
      <a href="{{ $urls->technical_video_url }}"><button>Technical video url </button></a>
      <a href="{{ $urls->sql_query_url }}"><button>Functional video url </button></a>
      @php
    
  }else{
    //in case of matching page_url before 'help=technical'
   

    @endphp
    <a href="{{ $urls['functional_video_url'] }}"><button>Functional video url </button></a>
    <a href="{{ $urls->technical_video_url }}"><button>Technical video url </button></a>
    <a href="{{ $urls->sql_query_url }}"><button>Functional video url </button></a>
    @php

    
  }
}
@endphp

