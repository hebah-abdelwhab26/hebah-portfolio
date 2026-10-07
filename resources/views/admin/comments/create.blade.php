@extends('admin.layouts.app')

@section('title', __('digital_studio_admin.comments.create.title'))


@section('content')

<div class="page-wrapper fade-up">


    <!--==================================
            PAGE HEADER
    ==================================-->

    <div class="dashboard-header">


        <div class="dashboard-header-left">


            <div class="dashboard-breadcrumb">

                <i class="fa-solid fa-comments"></i>

                <span>
                    {{ __('digital_studio_admin.comments.create.breadcrumb.comments') }}
                </span>

                <i class="fa-solid fa-angle-right"></i>

                <span>
                    {{ __('digital_studio_admin.comments.create.breadcrumb.create') }}
                </span>

            </div>


            <h1>

                {{ __('digital_studio_admin.comments.create.page_header.title') }}

            </h1>


            <p>

                {{ __('digital_studio_admin.comments.create.page_header.description') }}

            </p>


        </div>



        <div class="dashboard-header-right">


            <a href="{{ route('admin.comments.index') }}"
               class="btn btn-light rounded-pill px-4">


                <i class="fa-solid fa-arrow-left me-2"></i>

                {{ __('digital_studio_admin.comments.create.page_header.back') }}


            </a>


        </div>


    </div>




    @if($errors->any())

        <div class="alert alert-danger rounded-4 shadow-sm mb-4">


            <ul class="mb-0">


                @foreach($errors->all() as $error)

                    <li>

                        {{ $error }}

                    </li>

                @endforeach


            </ul>


        </div>

    @endif





    <form action="{{ route('admin.comments.store') }}"
          method="POST">


        @csrf



        <!--==================================
                COMMENT INFORMATION
        ==================================-->


       <!--==================================
        COMMENT TYPE
==================================-->

<div class="admin-card mb-4">


    <div class="d-flex align-items-center mb-4">


        <div class="dashboard-icon me-3">

            <i class="fa-solid fa-link"></i>

        </div>


        <div>

            <h4 class="card-title mb-1">

                {{ __('digital_studio_admin.comments.create.comment_type.title') }}

            </h4>


            <small>

                {{ __('digital_studio_admin.comments.create.comment_type.description') }}

            </small>


        </div>


    </div>



    <div class="row">


        <!-- Comment Type -->

        <div class="col-md-6 mb-4">


            <label class="form-label fw-semibold">

                {{ __('digital_studio_admin.comments.create.comment_type.type') }}

            </label>


            <select

                id="commentType"

                class="form-select">


                <option value="general">

                    {{ __('digital_studio_admin.comments.create.comment_type.general') }}

                </option>


                <option value="project">

                    {{ __('digital_studio_admin.comments.create.comment_type.project') }}

                </option>


            </select>


        </div>





        <!-- Project -->

        <div class="col-md-6 mb-4 d-none"
             id="projectBox">


            <label class="form-label fw-semibold">

                {{ __('digital_studio_admin.comments.create.comment_type.project_label') }}

            </label>


            <select

                name="commentable_id"

                class="form-select">


                <option value="">

                    {{ __('digital_studio_admin.comments.create.comment_type.select_project') }}

                </option>


                @foreach(\App\Models\Project::latest()->get() as $project)


                    <option value="{{ $project->id }}">

                        {{ $project->title }}

                    </option>


                @endforeach


            </select>


            <input

                type="hidden"

                name="commentable_type"

                value="App\Models\Project">


        </div>


    </div>


</div>





        <!--==================================
                RELATION
        ==================================-->


        <div class="admin-card mb-4">


            <div class="d-flex align-items-center mb-4">


                <div class="dashboard-icon me-3">


                    <i class="fa-solid fa-link"></i>


                </div>



                <div>


                    <h4 class="card-title mb-1">

                        {{ __('digital_studio_admin.comments.create.related_item.title') }}

                    </h4>


                    <small>

                        {{ __('digital_studio_admin.comments.create.related_item.description') }}

                    </small>


                </div>


            </div>





            <div class="row">



                <div class="col-md-6 mb-4">


                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.comments.create.related_item.type') }}

                    </label>


                    <select

                        name="commentable_type"

                        class="form-select">


                        <option value="">

                            {{ __('digital_studio_admin.comments.create.related_item.select_type') }}

                        </option>


                        <option value="App\Models\Project">

                            {{ __('digital_studio_admin.comments.create.related_item.project') }}

                        </option>


                        <option value="App\Models\Service">

                            {{ __('digital_studio_admin.comments.create.related_item.service') }}

                        </option>


                    </select>


                </div>




                <div class="col-md-6 mb-4">


                    <label class="form-label fw-semibold">

                        {{ __('digital_studio_admin.comments.create.related_item.item_id') }}

                    </label>


                    <input

                        type="number"

                        name="commentable_id"

                        class="form-control"

                        value="{{ old('commentable_id') }}"

                        placeholder="{{ __('digital_studio_admin.comments.create.related_item.item_id_placeholder') }}">


                </div>


            </div>


        </div>






        <!--==================================
                SETTINGS
        ==================================-->


        <div class="admin-card mb-4">


            <label class="form-label fw-semibold">

                {{ __('digital_studio_admin.comments.create.settings.status') }}

            </label>


            <select

                name="status"

                class="form-select">


                <option value="pending">

                    {{ __('digital_studio_admin.comments.create.settings.pending') }}

                </option>


                <option value="approved">

                    {{ __('digital_studio_admin.comments.create.settings.approved') }}

                </option>


                <option value="rejected">

                    {{ __('digital_studio_admin.comments.create.settings.rejected') }}

                </option>


            </select>


        </div>






        <!--==================================
                ACTIONS
        ==================================-->


        <div class="admin-card">


            <div class="d-flex justify-content-end gap-3">


                <a href="{{ route('admin.comments.index') }}"
                   class="btn btn-light rounded-pill px-4">


                    {{ __('digital_studio_admin.comments.create.actions.cancel') }}


                </a>




                <button type="submit"
                        class="btn btn-primary rounded-pill px-5">


                    <i class="fa-solid fa-floppy-disk me-2"></i>

                    {{ __('digital_studio_admin.comments.create.actions.save') }}


                </button>


            </div>


        </div>



    </form>



</div>









<script>

document
.getElementById('commentType')
.addEventListener('change', function(){


    let box =
        document.getElementById('projectBox');


    if(this.value === 'project'){

        box.classList.remove('d-none');

    }else{

        box.classList.add('d-none');

    }


});


</script>

@endsection
