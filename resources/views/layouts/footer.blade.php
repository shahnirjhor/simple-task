<footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
        {{ $applicationSetting->item_name }}{{ " Version : ".$applicationSetting->item_version }}
    </div>
    {{ "All Rights Reserved ".date("Y") }} &copy; <strong>{{ $applicationSetting->company_name }}</strong>
</footer>
