<div class="col-lg-3 col-6">
    <div class="small-box bg-{{ $colorClass }}">
        <div class="inner">
            {{ $slot }}
        </div>
        <div class="icon">
            <i class="{{ $icon }}"></i>
        </div>
        <a href="{{ $url }}" class="small-box-footer">Подробнее <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
