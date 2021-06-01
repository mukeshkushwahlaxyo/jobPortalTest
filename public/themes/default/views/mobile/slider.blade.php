<section>
    <div id="ei-slider" class="ei-slider">
        <ul class="ei-slider-large">
            @foreach($sliders as $slider)
                <li>
                    <a href="{{ $slider['link'] }}">
                        <img src="{{ get_storage_file_url($slider['mobile_image']['path'], 'full') }}" alt="{{ $slider['title'] ?? 'Slider Image ' . $loop->count }}">
                    </a>
                </li>
            @endforeach
        </ul><!-- ei-slider-large -->
    </div>
</section>