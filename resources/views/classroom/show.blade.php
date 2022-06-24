<div class="modal fade text-center" id="viewModal{{ $class->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Datos del Aula</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="card-title"><span class="text-secondary">Nombre:<br><br></span>
                    {{ $class->classroom_name }}</h5>
                <hr>
                <p class="card-title"><span class="text-secondary">Locación:</span>
                    {{ $class->location }}</p>
                <hr>
                <p class="card-title"><span class="text-secondary">Edificio:</span>
                    {{ $class->building }}</p>
                <hr>
                <p class="card-title"><span class="text-secondary">Tipo de aula:</span>
                    {{ $class->type }}</p>
                <hr>
                <p class="card-text statusUpdate"><span class="text-secondary">Estado:
                    </span>
                    @if (!isset($class->deleted_at))
                        Habilitada
                    @else
                        Deshabilitada
                    @endif
                </p>
                <hr>
                @php
                     $nameImg = $class->classroom_name;
                    // if (File::exists(public_path('mapa_aulas/'.$nameImg.'.png'))) {
                    //     echo ('<img id="image_classroom" width="350px" height="500px" src="{{ asset("assets/mapa_aulas/" '. $nameImg .' ".png") }}"alt="Aula_i1">');
                    // } else {
                    //     echo ('<p>No hay imagen disponible.</p>');
                    // }
                    
                    if (strpos($nameImg, 'FAIFi') !== false) {
                        echo ('<img id="image_classroom" width="350px" height="500px" src="../../../assets/mapa_aulas/'. $nameImg .'.png" alt="Aula_i1">');
                    } else {
                        echo ('<p>No hay imagen disponible.</p>');
                    }
            
                @endphp

                {{-- <img id="image_classroom" width="350px" height="500px" src="{{ asset('assets/mapa_aulas/' . $nameImg . '.png') }}"alt="Aula_i1"> --}}

            </div>
        </div>
    </div>
</div>
