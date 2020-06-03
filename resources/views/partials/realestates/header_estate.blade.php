<h4>{{ __("Agente") }}: {{ $estate->agent->user->name }} </h4>
<h4>{{ __("Precio") }}: {{ number_format($estate->price, 2, ',', '.') }} €</h4>
<h4>{{ __("Categoría") }}: {{ $estate->category->name }} </h4>
<h5>{{ __("Fecha de publicación") }}: {{ $estate->created_at->format('d/m/Y') }} </h5>
<h5>{{ __("Fecha de actualización") }}: {{ $estate->updated_at->format('d/m/Y') }} </h5>
<h6>{{ __("Seguido por") }}: {{ $estate->clients_count }} </h6>
<h6>{{ __("Número de valoraciones") }}: {{ $estate->reviews_count }} </h6>