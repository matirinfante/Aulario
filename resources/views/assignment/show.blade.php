<div class="modal fade" id="viewModal{{ $assignment->id }}" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Datos de la materia</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal"
                       aria-label="Close"></button>
           </div>
           <div class="modal-body">
               <h5 class="card-title"><span
                       class="text-secondary">Nombre:<br><br></span>
                   {{ $assignment->assignment_name }}</h5>
               <hr>
               <p class="card-text"><span class="text-secondary">Cursada:</span>
                   @if ($assignment->active == 1)
                       En curso
                   @else
                       Inactiva
                   @endif
               </p>
               <hr>
               <p class="card-text"><span class="text-secondary">Fecha de
                       inicio:</span>
                   @if (isset($assignment->start_date))
                       {{ date('d/m/Y', strtotime($assignment->start_date)) }}
                   @else
                       No disponible
                   @endif
               </p>
               <hr>
               <p class="card-text"><span class="text-secondary">Fecha de fin:</span>
                   @if (isset($assignment->finish_date))
                       {{ date('d/m/Y', strtotime($assignment->finish_date)) }}
                   @else
                       No disponible
                   @endif
               </p>
               <hr>
               <p class="card-text"><span class="text-secondary">Estado:
                   </span>
                   @if (!isset($assignment->deleted_at))
                       Habilitada
                   @else
                       Deshabilitada
                   @endif
               </p>
               <hr>
               <p class="card-text"><span class="text-secondary">Creación:
                   </span>
                   @if (isset($assignment->created_at))
                       {{ date('d/m/Y - h:i:s', strtotime($assignment->created_at)) }}
                   @else
                       No disponible
                   @endif
               </p>
               <hr>
               <p class="card-text"><span class="text-secondary">Última modificación:
                   </span>
                   @if (isset($assignment->updated_at))
                       {{ date('d/m/Y - h:i:s', strtotime($assignment->updated_at)) }}
                   @else
                       No disponible
                   @endif
               </p>
           </div>
       </div>
   </div>
</div>