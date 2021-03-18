@php
    $variables = $variables ?? $field->options();
    $variables = $variables['system::lang.mail_variables.text_group_order'];

@endphp
<div class="w-100 flex-column{{ $cssClass ?? '' }}">
    <div
        id="email-variables"
        class="card card-body bg-white mt-2"
    >
        <p class="small">@lang('lang:cupnoodles.printlayouts::default.variables_help')</p>

                @foreach ($variables as $variable => $label)
                    <span
                        class="badge border mb-2 text-muted text-draggable"
                        title="@lang($label)"
                        style="font-size: 100%;"
                        draggable="true"
                        ondragstart="event.dataTransfer.setData('text/plain', event.target.innerText)">
                    {{ $variable }}</span>
                @endforeach
            </div>

    </div>
</div>
