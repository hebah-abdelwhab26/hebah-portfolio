<div class="admin-card chart-card">

    <div class="chart-header">

        <div class="chart-title">

            <h5>

                {{ __('digital_studio_admin.dashboard.chart.title') }}

            </h5>

            <small>

                {{ __('digital_studio_admin.dashboard.chart.description') }}

            </small>

        </div>


        <span class="chart-badge">

            {{ __('digital_studio_admin.dashboard.chart.last_6_months') }}

        </span>

    </div>


    <div id="projectsChart"></div>

</div>


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>

const options = {

    chart: {

        type: 'area',

        height: 340,

        toolbar: {

            show: false

        },

        zoom: {

            enabled: false

        }

    },


    series: [

        {

            name: @json(
                __('digital_studio_admin.dashboard.chart.projects')
            ),

            data: @json($chartData)

        }

    ],


    xaxis: {

        categories: @json($chartMonths)

    },


    stroke: {

        curve: 'smooth',

        width: 4

    },


    colors: ['#2563EB'],


    fill: {

        type: 'gradient',

        gradient: {

            shadeIntensity: 1,

            opacityFrom: .45,

            opacityTo: .05,

            stops: [0, 90, 100]

        }

    },


    dataLabels: {

        enabled: false

    },


    grid: {

        borderColor: 'rgba(255,255,255,.05)'

    },


    tooltip: {

        theme: 'dark'

    }

};


new ApexCharts(

    document.querySelector("#projectsChart"),

    options

).render();

</script>

@endpush

