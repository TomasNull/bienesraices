<div class="seccion-inferior contenedor">
    <section class="blog">
        <h3 class="centrar-texto fw-300">{{ __("Nuestro Blog") }}</h3>

        <article class="entrada-blog">
            <div class="imagen">
                <img src="{{ url('/images/blog1.jpg') }}" alt="Blog Terraza">
            </div>
            <div class="texto-entrada">
                <h4>{{ __("Terraza en el techo de tu casa") }}</h4>
                <p>{{ __("Escrito el: ") }}<span> XX/01/2020 </span> {{ __("por: ") }}<span> Admin </span></p>
                <p>Consejos para construir una terraza en el techo de tu casa, con los mejores materiales
                    y ahorrando dinero.</p>
            </div>
        </article>
        
        <article class="entrada-blog">
            <div class="imagen">
                <img src="{{ url('/images/blog2.jpg') }}" alt="Blog Decoración">
            </div>
            <div class="texto-entrada">
                <h4>{{ __("Guía para la decoración de tu hogar") }}</h4>
                <p>{{ __("Escrito el: ") }}<span> XX/01/2020 </span> {{ __("por:") }}<span> Admin </span></p>
                <p>Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores
                    para darle vida a tu espacio.</p>
            </div>
        </article>
    </section>

    <section class="comentarios">
        <h3 class="centrar-texto fw-300">{{ __("Comentarios") }}</h3>
        <div class="comentario">
            <blockquote>
                El personal se comportó de una excelente forma, muy buena atención y la casa que me 
                ofrecieron cumple con todas mis expectativas.
            </blockquote>
            <p>- Tomás Moreni</p>
        </div>
    </section>
</div>