$(function () {
    "use strict";
    
    // Slug
    $('body').on('blur', '.mask_slug', function maskslugKeyup(e) {
        var $this, val;
        $this = $(this);
        val = $this.val();
        $this.val(val.replace(/[^a-z0-9]/gi, '-'));
    });

    // Copiar do name caso exista
    if ($('#name').size() && $('#slug').size()) {
        var $name, $slug;

        $name = $('#name');
        $slug = $('#slug');

        $name.blur(function maskslugBlur() {
            $slug.val($name.val()).blur();
        });

        if ($('#name').size() && $('.mask_slug').size()) {
            $('#name').blur(function () {
                if (!$('.mask_slug').val().length) {
                    $('.mask_slug').val($('#name').val()).keyup();
                }
            });
        }
    }

    // DELETE RECORD
    $('body').delegate('[data-delete]', 'click', function () {
        var $this = $(this),
            href = $this.attr('data-delete'),
            message = $this.attr('data-message') || 'Você tem certeza que deseja remover este registro?',
            $form = {};

        if (!href) {
            return;
        }

        if (confirm(message)) {
            $form = $('<form method="post" action="' + href + '"></form>');
            $form.append($('<input type="hidden" name="_method" value="delete"/>'))
                    .appendTo($('body')).submit();
        }
    });

    // ASK CONFIRMATION
    $('body').delegate('[data-confirm]', 'click', function () {
        var $this = $(this),
            message = $this.attr('data-label'),
            url = $this.attr('data-confirm'),
            callback = $this.attr('data-callback'),
            method = $this.attr('data-method'),
            $form = {};

        if (method === undefined) {
            method = 'POST';
        }

        if (typeof window[callback] === 'function') {
            window[callback]($this);
        } else {
            if (confirm(message)) {
                $form = $('<form method="post" action="' + url + '"></form>')
                    .append($('<input type="hidden" name="_method" value="' + method + '" />'))
                    .appendTo($('body')).submit();
            }
        }
    });

    $('.apply-datepicker').each(function () {
        var $this = $(this),
            format = $this.attr('data-format'),
            locale = $this.attr('data-locale'),
            defaultValue = $this.attr('data-default'),
            t = null,
            val = $this.val();

        if (format === undefined) {
            format = 'YYYY-MM-DD hh:mm';
        }

        if (locale === undefined) {
            locale = 'br';
        }

        $this.appendDtpicker({
            "autodateOnStart": false,
            locale: locale,
            dateFormat: format
        });

        // gambiarra!!
        if (val.length > 16) {
            $this.val(val.substr(0,16));
        }
    });
});