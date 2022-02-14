@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
@livewire('popular-games')
        <!-- start recently viewed and most-anticipated and coming soon -->
        <div class="flex mt-10 flex-col xl:flex-row">
            @livewire('recently-reviewed')
            <div class="most-anticipated-and-coming-soon-container w-full md:mt-10 space-y-10 ">
                
                @livewire('most-anticipated')
                @livewire('coming-soon')
            </div>
        </div>
    </div> <!-- End Container-->



@endsection
