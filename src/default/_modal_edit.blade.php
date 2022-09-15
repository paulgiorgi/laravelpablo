<!-- Modal -->

<div class="modal fade modal-request" id="_modal_edit" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <strong>{{$modal_title}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

        <form id="modal_form" method="POST" enctype="multipart/form-data" >
        @csrf

        <div class="container p-3 px-4">
        {{$modal_form_fields}}
        </div>

      <div class="modal-footer p-1">
        <button type="button" class="btn btn-outline-secondary mb-2 me-4" id="save_modal">SALVA</button>
      </div>

      </form>

    </div>
  </div>
</div>
