<div class="modal fade" id="viewModal{{ $class->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Datos del aula</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="card-title"><span class="text-secondary">Nombre:<br><br></span>
                    {{ $class->classroom_name }}</h5>
                <hr>
                <p class="card-text"><span class="text-secondary">Locación:</span>
                    {{ $class->location }}
                </p>
                <hr>
                <p class="card-text"><span class="text-secondary">Edificio:</span>
                    {{ $class->building }}
                </p>
                <hr>
                <p class="card-text"><span class="text-secondary">Capacidad:</span>
                    {{ $class->capacity }}
                </p>
                <hr>
                <p class="card-text"><span class="text-secondary">Tipo de aula:</span>
                    {{ $class->type }}
                </p>
                <hr>
                {{-- <p class="card-text"><span class="text-secondary">Hora de
                        inicio:</span>
                    @if (isset($class->available_start))
                        {{ date('h:i:s', strtotime($class->available_start)) }}
                    @else
                        No disponible
                    @endif
                </p>
                <hr>
                <p class="card-text"><span class="text-secondary">Hora de fin:</span>
                    @if (isset($class->available_finish))
                        {{ date('h:i:s', strtotime($class->available_finish)) }}
                    @else
                        No disponible
                    @endif
                </p>
                <hr> --}}
                <p class="card-text"><span class="text-secondary">Estado:
                   </span>
                   @if (!isset($class->deleted_at))
                       Habilitada
                   @else
                       Deshabilitada
                   @endif
               </p>
                {{-- <hr>
                <p class="card-text"><span class="text-secondary">Creación:
                    </span>
                    @if (isset($class->created_at))
                        {{ date('d-m-Y | h:i:s', strtotime($class->created_at)) }}
                    @else
                        No disponible
                    @endif
                </p>
                <hr>
                <p class="card-text"><span class="text-secondary">Última modificación:
                    </span>
                    @if (isset($class->updated_at))
                        {{ date('d-m-Y | h:i:s', strtotime($class->updated_at)) }}
                    @else
                        No disponible
                    @endif
                </p> --}}
            </div>
        </div>
    </div>
</div>
