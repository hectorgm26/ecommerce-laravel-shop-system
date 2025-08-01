<P>Hector el Father</P>
<p>Haz solicitado un enlace para recuperar su contraseña.</p>
<p>Haz clic en el siguiente enlace para reestablecerla: </p>
<a href="{{ url('/password/reset/'.$token) }}">
    Reestablecer contraseña
</a>
<p>Si no ha solicitado este cambio, ignore este correo electrónico.</p>

{{-- ESTE SERA LA ESTRUCTURA DEL CORREO --}}