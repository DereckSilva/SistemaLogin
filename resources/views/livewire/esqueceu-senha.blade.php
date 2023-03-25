<div>
    <!--componente para envio de e-mail-->
    @if(empty($cod))
        <x-send-email-forget-password />
    @endif
    <!--componente para inserção do código-->
    @if(!empty($cod))
        <x-send-cod-forget-password />
    @endif
</div>
