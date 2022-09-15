<!-- Modal -->

@php
use Carbon\Carbon;
@endphp

<div class="modal fade modal-request my-5 modal-dialog-scrollable" id="_adv_filter" data-bs-backdrop="static" data-bs-keyboard="true" aria-labelledby="staticBackdropLabel" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content p-2">
      <div class="modal-header">
      <span>FILTRO AVANZATO</span>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="container p-3 px-4">

        <div class="form-group row my-2">
            <label class="col-3 text-end">Data</label>
            <div class="col-4">
                <input name="start_date" type="date" class="form-filter form-control start_date" placeholder="Da">
            </div>
            <div class="col-4">
                <input name="end_date" type="date" class="form-filter form-control end_date" placeholder="A">
            </div>
        </div>

      </div>

      <div class="modal-footer p-1">
        <button type="button" class="btn" id="go_filter">FILTRA <i class="las la-search"></i></button>
      </div>

    </div>
  </div>
</div>

