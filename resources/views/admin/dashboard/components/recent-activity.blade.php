<div class="admin-card recent-activity-card">

    <div class="activity-header">

        <h3>

            {{ __('digital_studio_admin.dashboard.recent_activity.title') }}

        </h3>

        <p>

            {{ __('digital_studio_admin.dashboard.recent_activity.description') }}

        </p>

    </div>


    @if($activities->count())

        <div class="activity-list">

            @foreach($activities as $activity)

                <div class="activity-item">

                    <div class="activity-icon {{ $activity['color'] }}">

                        <i class="fa-solid {{ $activity['icon'] }}"></i>

                    </div>


                    <div class="activity-content">

                        <strong>

                            {{ $activity['title'] }}

                        </strong>

                        <p>

                            {{ $activity['description'] }}

                        </p>

                        <div class="activity-time">

                            {{ $activity['time']->diffForHumans() }}

                        </div>

                    </div>

                </div>

            @endforeach

        </div>


    @else

        <div class="activity-empty">

            <i class="fa-solid fa-clock-rotate-left"></i>

            <h4>

                {{ __('digital_studio_admin.dashboard.recent_activity.empty_title') }}

            </h4>

            <p>

                {{ __('digital_studio_admin.dashboard.recent_activity.empty_description') }}

            </p>

        </div>

    @endif

</div>
