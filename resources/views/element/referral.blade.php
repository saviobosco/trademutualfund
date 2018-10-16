<referral-component
        :referral_link="{{ $referral_link }}"
        :displayUrl="{{ url('register').'/'.urlencode(auth()->user()->name) }}">
    <div>
        <div class="input-group">
            <input id="referral-link" type="text" value="{{ $referral_link }}" class="form-control" aria-describedby="basic-addon2" readonly>
            <span class="input-group-btn">
                <button class="btn btn-default" type="button" data-toggle="tooltip" title="copied" data-clipboard-target="#referral-link" id="copy-ref"> Copy </button>
            </span>
        </div>

        <p>
            <a target="_blank" href="{{ $referral_link }}">
                @{{ displayUrl }}
            </a>
        </p>
        <p> Share on social media </p>
        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=@{{ referral_link }}" class="btn btn-primary btn-icon btn-circle btn-lg m-r-10">
            <i class="fa fa-facebook"></i>
        </a>
        <a target="_blank" href="https://plus.google.com/share?url=@{{ referral_link }}" class="btn btn-info btn-icon btn-circle btn-lg m-r-10">
            <i class="fa fa-twitter"></i>
        </a>
        <a target="_blank" href="https://twitter.com/share?url=@{{ referral_link }}" class="btn btn-danger btn-icon btn-circle btn-lg">
            <i class="fa fa-google-plus"></i>
        </a>
    </div>
</referral-component>