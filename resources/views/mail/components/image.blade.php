<div align="center" class="img-container center fixedwidth fullwidthOnMobile" style="padding-right: 40px;padding-left: 40px;">
    <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 40px;padding-left: 40px;" align="center"><![endif]-->
    @if(isset($href))<a href="{{ isset($href) ? $href : '#' }}" style="outline:none" tabindex="-1" target="_blank">@endif
        <img align="center"
             alt="I'm an image"
             border="0"
             class="center fixedwidth fullwidthOnMobile"
             src="{{ $slot }}"
             style="text-decoration: none; -ms-interpolation-mode: bicubic; height: auto; border: 0; width: 100%; max-width: {{ isset($width) ? $width : 352 }}px; display: block;"
             title="I'm an image"
             width="{{ isset($width) ? $width : 352 }}"/>
        @if(isset($href))</a>@endif
    <!--[if mso]></td></tr></table><![endif]-->
</div>
