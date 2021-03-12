<button class="form-submit-btn {{(isset($class)) ? $class : ''}}">
    <span class="form-submit-label">{{$label}}</span>
    <div class="form-submit-status fit-parent flex justify-center items-center">
        <div class="form-submit-loader loader"></div>
        <i class="form-submit-success fa fa-check text-2xl"></i>
    </div>
</button>