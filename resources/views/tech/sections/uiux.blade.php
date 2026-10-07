<section class="uiux-section" id="uiux">


<div class="container">

    <!--==================================
                SECTION HEADER
    ==================================-->

    <div class="uiux-header">

        <span class="section-badge" style="color: #f2b824">

            {{ __('digital_studio.uiux.badge') }}

        </span>

        <h2>

            {{ __('digital_studio.uiux.heading') }}

            <span>{{ __('digital_studio.uiux.heading_highlight') }}</span>

        </h2>

        <p>

            {{ __('digital_studio.uiux.description') }}

        </p>

    </div>



    <!--==================================
                FILTERS
    ==================================-->

    <div class="uiux-filters">

        <button
            class="filter-btn active"
            data-filter="all">

            {{ __('digital_studio.uiux.all') }}

        </button>



        @foreach($designCategories as $category)

            <button
                class="filter-btn"
                style="background: #13203c"
                data-filter="{{ $category->slug }}">

                {{ $category->name }}

            </button>

        @endforeach

    </div>




    <!--==================================
            WEB DESIGN SECTION
    ==================================-->

    <div class="design-category">

        <h3>

            <i class="fa-solid fa-display"></i>

            {{ __('digital_studio.uiux.website_designs') }}

        </h3>

    </div>




    <div class="design-grid">

        @forelse($webDesignProjects as $project)

            <div
                class="design-card"
                data-category="{{ $project->category->slug ?? '' }}"
                data-url="{{ route('figma.show',$project->slug) }}"
            >

                <!-- IMAGE -->

                <div class="design-image">

                    <img
                        src="{{ $project->cover_image_url }}"
                        alt="{{ $project->title }}"
                        class="preview-image"
                        data-title="{{ $project->title }}"
                        data-category="{{ $project->category->name ?? 'Web Design' }}"
                        data-type="Desktop"
                    >

                    <div class="design-overlay">

                        <a
                            href="{{ $project->cover_image_url }}"
                            class="project-btn portfolio-lightbox"
                            data-gallery="figma-web"
                        >

                            <i class="fa-solid fa-magnifying-glass-plus"></i>

                        </a>


                        <a
                            href="{{ route('figma.show',$project->slug) }}"
                            class="project-btn"
                        >

                            <i class="fa-solid fa-eye"></i>

                        </a>


                        @if($project->figma)

                            <a
                                href="{{ $project->figma }}"
                                target="_blank"
                                class="project-btn"
                            >

                                <i class="fa-brands fa-figma"></i>

                            </a>

                        @endif

                    </div>

                </div>



                <!-- CONTENT -->

                <div class="design-content">

                    @if($project->category)

                        <span class="project-category">

                            {{ $project->category->name }}

                        </span>

                    @endif


                    <h4>

                        {{ $project->title }}

                    </h4>


                    <p>

                        {{ \Illuminate\Support\Str::limit(
                            $project->short_description,
                            120
                        ) }}

                    </p>


                    <div class="design-tags">

                        <span>

                            Figma

                        </span>


                        @foreach($project->technologies->take(2) as $technology)

                            <span>

                                {{ $technology->name }}

                            </span>

                        @endforeach

                    </div>

                </div>

            </div>

        @empty

            <div class="empty-projects">

                <i class="fa-regular fa-folder-open"></i>

                <h3>

                    {{ __('digital_studio.uiux.no_web_designs') }}

                </h3>

                <p>

                    {{ __('digital_studio.uiux.no_web_designs_description') }}

                </p>

            </div>

        @endforelse

    </div>


    <!--==================================
            MOBILE DESIGN SECTION
    ==================================-->

    <div class="design-category">

        <h3>

            <i class="fa-solid fa-mobile-screen-button"></i>

            {{ __('digital_studio.uiux.mobile_designs') }}

        </h3>

    </div>




    <div class="mobile-grid">

        @forelse($mobileProjects as $project)

            <div
                class="phone-card"
                data-category="{{ $project->category->slug ?? '' }}"
                data-url="{{ route('figma.show',$project->slug) }}"
            >

                <!-- PHONE FRAME -->

                <div class="phone-frame">

                    <div class="phone-notch"></div>

                    <div class="phone-screen">

                        <img
                            src="{{ $project->cover_image_url }}"
                            alt="{{ $project->title }}"
                            class="preview-image"
                            data-title="{{ $project->title }}"
                            data-category="{{ $project->category->name ?? 'Mobile Design' }}"
                            data-type="Mobile"
                        >

                        <div class="design-overlay">

                            <a
                                href="{{ $project->cover_image_url }}"
                                class="project-btn portfolio-lightbox"
                                data-gallery="figma-mobile"
                            >

                                <i class="fa-solid fa-magnifying-glass-plus"></i>

                            </a>


                            <a
                                href="{{ route('figma.show',$project->slug) }}"
                                class="project-btn"
                            >

                                <i class="fa-solid fa-eye"></i>

                            </a>


                            @if($project->figma)

                                <a
                                    href="{{ $project->figma }}"
                                    target="_blank"
                                    class="project-btn"
                                >

                                    <i class="fa-brands fa-figma"></i>

                                </a>

                            @endif

                        </div>

                    </div>

                </div>


                <!-- CONTENT -->

                <div class="design-content">

                    <h4>

                        {{ $project->title }}

                    </h4>


                    <p>

                        {{ \Illuminate\Support\Str::limit(
                            $project->short_description,
                            100
                        ) }}

                    </p>


                    <div class="design-tags">

                        <span>

                            Figma

                        </span>


                        @foreach($project->technologies->take(2) as $technology)

                            <span>

                                {{ $technology->name }}

                            </span>

                        @endforeach

                    </div>

                </div>

            </div>

        @empty

            <div class="empty-projects">

                <i class="fa-solid fa-mobile-screen-button"></i>

                <h3>

                    {{ __('digital_studio.uiux.no_mobile_designs') }}

                </h3>

                <p>

                    {{ __('digital_studio.uiux.no_mobile_designs_description') }}

                </p>

            </div>

        @endforelse

    </div>



    <!--==================================
            DASHBOARD DESIGN SECTION
    ==================================-->

    <div class="design-category">

        <h3>

            <i class="fa-solid fa-chart-pie"></i>

            {{ __('digital_studio.uiux.dashboard_designs') }}

        </h3>

    </div>




    <div class="design-grid">

        @forelse($dashboardDesignProjects as $project)

            <div
                class="design-card"
                data-category="{{ $project->category->slug ?? '' }}"
                data-url="{{ route('figma.show',$project->slug) }}"
            >

                <div class="design-image">

                    <img
                        src="{{ $project->cover_image_url }}"
                        alt="{{ $project->title }}"
                        class="preview-image"
                        data-title="{{ $project->title }}"
                        data-category="{{ $project->category->name ?? 'Dashboard Design' }}"
                        data-type="Dashboard"
                    >

                    <div class="design-overlay">

                        <a
                            href="{{ $project->cover_image_url }}"
                            class="project-btn portfolio-lightbox"
                            data-gallery="figma-dashboard"
                        >

                            <i class="fa-solid fa-magnifying-glass-plus"></i>

                        </a>


                        <a
                            href="{{ route('figma.show',$project->slug) }}"
                            class="project-btn"
                        >

                            <i class="fa-solid fa-eye"></i>

                        </a>


                        @if($project->figma)

                            <a
                                href="{{ $project->figma }}"
                                target="_blank"
                                class="project-btn"
                            >

                                <i class="fa-brands fa-figma"></i>

                            </a>

                        @endif

                    </div>

                </div>


                <div class="design-content">

                    <span class="project-category">

                        {{ __('digital_studio.uiux.dashboard_design') }}

                    </span>


                    <h4>

                        {{ $project->title }}

                    </h4>


                    <p>

                        {{ \Illuminate\Support\Str::limit(
                            $project->short_description,
                            120
                        ) }}

                    </p>


                    <div class="design-tags">

                        <span>

                            Figma

                        </span>


                        @foreach($project->technologies->take(2) as $technology)

                            <span>

                                {{ $technology->name }}

                            </span>

                        @endforeach

                    </div>

                </div>

            </div>

        @empty

            <div class="empty-projects">

                <i class="fa-solid fa-chart-pie"></i>

                <h3>

                    {{ __('digital_studio.uiux.no_dashboard_designs') }}

                </h3>

                <p>

                    {{ __('digital_studio.uiux.no_dashboard_designs_description') }}

                </p>

            </div>

        @endforelse

    </div>

</div>


</section>

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | UI / UX FILTERS
    |--------------------------------------------------------------------------
    */

    const filters = document.querySelectorAll('.filter-btn');

    const cards = document.querySelectorAll(
        '.design-card, .phone-card'
    );


    filters.forEach(function(button){

        button.addEventListener('click', function(){

            filters.forEach(function(btn){

                btn.classList.remove('active');

            });


            this.classList.add('active');


            const filter = this.dataset.filter;


            cards.forEach(function(card){

                const category =
                    card.dataset.category || '';


                if(
                    filter === 'all'
                    ||
                    category === filter
                ){

                    card.style.display = '';

                }else{

                    card.style.display = 'none';

                }

            });

        });

    });


    /*
    |--------------------------------------------------------------------------
    | CARD CLICK REDIRECT
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('[data-url]')
        .forEach(function(card){

            card.addEventListener('click', function(e){

                if(
                    e.target.closest('.project-btn')
                ){

                    return;

                }


                window.location.href =
                    this.dataset.url;

            });

        });

});

</script>

@endpush
