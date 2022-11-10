<div class="modal fade" id="share_card_modal" tabindex="-1"
aria-labelledby="share_card_modalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content bg-primary text-white border-0">
        <div class="modal-header border-0">
            <h5 class="modal-title text-center" id="share_card_modalLabel">
                {{ trans('labels.share_card') }}</h5>
            <a type="button" class="text-white" data-bs-dismiss="modal"
                aria-label="Close">
                <i class="fa-regular fa-xmark"></i>
            </a>
        </div>
        <div class="modal-body">
            <div class="text-center qr-code">
                <img src="https://chart.googleapis.com/chart?cht=qr&chl={{ URL::to('/' . $basicinfo->slug) }}&chs=160x160"
                    alt="">
                <div class="py-5">
                    <h5> {{ trans('labels.qr_code') }}</h5>
                    <a class="text-white" target="_blank"
                        href="{{ URL::to('/' . $basicinfo->slug) }}">{{ URL::to('/' . $basicinfo->slug) }}</a>
                </div>
                <div class="modal-social">
                    <p>{{ trans('labels.social_channels') }}</p>
                    <div class="row">
                        <div class="text-center">
                            <a href="http://twitter.com/share?text={{ $basicinfo->name }}&url={{ URL::to('/' . $basicinfo->slug) }}" target="_blank" class="social twitter-icon">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ URL::to('/' . $basicinfo->slug) }}" target="_blank" class="social linkedin-icon">
                                <i class="fa-brands fa-linkedin"></i>
                            </a>
                            <a href="https://web.whatsapp.com/send?text={{ URL::to('/' . $basicinfo->slug) }} " target="_blank" class="social whatsapp-icon">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer.php?u={{ URL::to('/' . $basicinfo->slug) }}" target="_blank" class="social facebook-icon">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>