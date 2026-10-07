<section class="portfolio-section" id="portfolio">


<div class="container">

    <!--==================================
            SECTION HEADER
    ==================================-->

    <div class="portfolio-header">

        <span class="section-badge" style="color: #f2b824">
            {{ __('digital_studio.portfolio.badge') }}
        </span>


        <h2>

            {{ __('digital_studio.portfolio.heading') }}

            <span>{{ __('digital_studio.portfolio.heading_highlight') }}</span>

        </h2>


        <p>

            {{ __('digital_studio.portfolio.description') }}

        </p>


    </div>



    <!--==================================
            PORTFOLIO FILTERS
    ==================================-->

    <div class="portfolio-filters">


        <button
            type="button"
            class="portfolio-filter active"
            data-filter="all">

            {{ __('digital_studio.portfolio.all') }}

        </button>



        @foreach($portfolioCategories as $category)


            <button

                type="button"

                class="portfolio-filter"
                style="background:#13203c"

                data-filter="{{ $category->slug }}">

                {{ $category->name }}

            </button>


        @endforeach



    </div>





    <!--==================================
            PORTFOLIO GRID
    ==================================-->

    <div class="portfolio-grid">



        @forelse($featuredProjects as $project)



            <div

                class="project-card"

                data-filter="{{ optional($project->category)->slug ?? 'all' }}">




                <!--==================================
                        PROJECT IMAGE
                ==================================-->


                <div class="project-image">



                    <img

                        src="{{ $project->thumbnail_url }}"

                        alt="{{ $project->title }}">





                    <div class="project-overlay">



                        <a

                            href="{{ route('projects.show',$project->slug) }}"

                            class="project-btn">


                            <i class="fa-solid fa-eye"></i>


                        </a>





                        @if($project->github)


                            <a

                                href="{{ $project->github }}"

                                target="_blank"

                                class="project-btn">


                                <i class="fa-brands fa-github"></i>


                            </a>


                        @endif






                        @if($project->live_demo)


                            <a

                                href="{{ $project->live_demo }}"

                                target="_blank"

                                class="project-btn">


                                <i class="fa-solid fa-arrow-up-right-from-square"></i>


                            </a>


                        @endif




                    </div>



                </div>





                <!--==================================
                        PROJECT CONTENT
                ==================================-->


                <div class="project-content">





                    @if($project->category)


                        <span class="project-category">


                            {{ $project->category->name }}


                        </span>


                    @endif






                    <h3>


                        {{ $project->title }}


                    </h3>





                    <p>


                        {{ \Illuminate\Support\Str::limit($project->short_description,140) }}


                    </p>







                    <!--==================================
                            PROJECT TAGS
                    ==================================-->



                    <div class="project-tags">



                        @foreach($project->technologies->take(4) as $technology)



                            <span>


                                {{ $technology->name }}


                            </span>



                        @endforeach



                    </div>





                </div>




            </div>




        @empty





            <!--==================================
                    EMPTY STATE
            ==================================-->



            <div class="empty-projects">



                <i class="fa-regular fa-folder-open"></i>



                <h3>


                    {{ __('digital_studio.portfolio.empty_title') }}


                </h3>




                <p>


                    {{ __('digital_studio.portfolio.empty_description') }}


                </p>




            </div>




        @endforelse





    </div>





    <!--==================================
            FOOTER BUTTON
    ==================================-->



    @if($featuredProjects->count())



        <div class="portfolio-footer">



            <a

                href="{{ route('projects.index') }}"

                class="primary-btn">



                {{ __('digital_studio.portfolio.view_all') }}



            </a>



        </div>



    @endif





</div>


</section>

@push('scripts')

<script>


document.addEventListener('DOMContentLoaded', function () {



    const filters = document.querySelectorAll('.portfolio-filter');

    const cards = document.querySelectorAll('.project-card');





    filters.forEach(function(filter){



        filter.addEventListener('click', function(){



            filters.forEach(function(btn){


                btn.classList.remove('active');


            });





            this.classList.add('active');





            const value = this.dataset.filter;





            cards.forEach(function(card){



                const category = card.dataset.filter;





                if(value === 'all' || value === category){



                    card.style.display = '';



                }else{



                    card.style.display = 'none';



                }



            });





        });



    });





});


</script>

@endpush
