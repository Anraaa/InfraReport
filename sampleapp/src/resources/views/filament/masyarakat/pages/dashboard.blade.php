<x-filament::page>
    <div class="space-y-6">
        <!-- Header Widgets (StatsOverview) -->
        @foreach ($this->getHeaderWidgets() as $widget)
            {{ $this->getWidget($widget) }}
        @endforeach

        <!-- Footer Widgets (RecentComplaintsWidget) -->
        @foreach ($this->getFooterWidgets() as $widget)
            {{ $this->getWidget($widget) }}
        @endforeach
    </div>
</x-filament::page>