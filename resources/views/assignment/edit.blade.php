<div class="modal fade updateModal" id="updateModal{{ $assignment->id }}" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Actualizar materia</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal"
                       aria-label="Close"></button>
           </div>
           <div class="modal-body">
               <form name="form_assignment" method="POST"
                     action="{{ route('assignments.update', $assignment->id) }}">
                   @csrf @method('PATCH')
                   {{-- nombre materia --}}
                   <div class="mb-3">
                       <label for="assignment_name" class="form-label">Nombre de
                           materia</label>
                       <input type="text" class="form-control" name="assignment_name"
                              value="{{ $assignment->assignment_name }}" id="assignmentNameUpdate{{ $assignment->id }}" required>
                       <small id="errorAssignmentNameUpdate{{ $assignment->id }}"></small>
                   </div>

                   {{-- fecha inicio --}}
                   <div class="mb-3">
                       <label for="start_date" class="form-label">Fecha de
                           inicio</label>
                       <input type="date" class="form-control" name="start_date"
                              value="{{ $assignment->start_date }}" id="assignmentStartDateUpdate{{ $assignment->id }}" required>
                       <small id="errorAssignmentStartDateUpdate{{ $assignment->id }}"></small>
                   </div>

                   {{-- fecha fin --}}
                   <div class="mb-3">
                       <label for="finish_date" class="form-label">Fecha fin</label>
                       <input type="date" class="form-control" name="finish_date"
                              value="{{ $assignment->finish_date }}" id="assignmentFinishDateUpdate{{ $assignment->id }}" required>
                       <small id="errorAssignmentFinishDateUpdate{{ $assignment->id }}"></small>
                   </div>

                   {{-- cuatrimestre --}}
                   <div class="mb-3">
                       <label for="cuatrimestre"
                              class="form-label">Cuatrimestre</label>
                       <select name="active" class="form-select select2-active"
                           aria-label="cuatrimestre" style="width: 100%"
                           data-minimum-results-for-search="Infinity">
                           <option value="-1" disabled></option>
                           <option value="0">Inactiva</option>
                           <option value="1">En curso</option>
                       </select>
                       <small id="errorActive"></small>
                   </div>

                   {{-- profesores --}}
                   <div class="mb-3">
                       <label for="nameTeacher" class="form-label">Profesor/a
                           asignado</label>
                       <select name="user_id[]" class="form-select select2-user"
                               multiple="multiple" aria-label="Profesor/a"
                               style="width: 100%">
                           <option value="-1" disabled></option>
                           @foreach ($users as $teacher)
                               <option value="{{ $teacher->id }}">
                                   {{ $teacher->name }}, {{ $teacher->surname }}
                               </option>
                           @endforeach
                       </select>
                       <small id="errorNameTeacher"></small>
                   </div>
                   <button id="updateSubmit{{ $assignment->id }}" type="submit"
                           class="btn btn-primary">Actualizar
                   </button>
               </form>
           </div>
       </div>
   </div>
</div>