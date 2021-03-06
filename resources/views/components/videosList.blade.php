<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">
<style type="text/css">
  .table,
  .table tbody,
  .table tbody tr,
  .table tbody td {
    display: block;
  }

    table.dataTable.cards {
        background-color: transparent;
        border-bottom: 0 !important;
    }

    .dataTable.cards tbody {
      display: flex;
      flex-wrap: wrap;
      margin: 0 -1%;
    }
    .dataTable.cards tbody tr {
      width: 100%;
      max-width: 100%;
      margin: 10px 1%;
      border: 1px solid #e3e6f0;
      box-shadow: 3px 3px 6px rgba(0,0,0,0.2);
      background-color: white;
    }
    .dataTable.cards tbody td {
      border: 0;
      display: block;
      width: 100%;
      overflow: hidden;
      padding: 4px 0;
      text-align: left;
    }

    /*---[ The remaining is just more dressing to fit my preferances ]-----------------*/
    .table {
        background-color: #fff;
    }
    .table tbody label {
        display: none;
        margin-right: 5px;
        width: 50px;
    }   
    .table .glyphicon {
        font-size: 20px;
    }

    .dataTable.cards .glyphicon {
        font-size: 75px;
    }

    .dataTable.cards tbody label {
        display: inline;
        position: relative;
        font-size: 85%;
        font-weight: normal;
        top: -5px;
        left: -3px;
        float: left;
        color: #808080;
    }
    .dataTable.cards tbody td:nth-child(1) {
        text-align: center;
    }
    @media (min-width: 768px) {
      .dataTable.cards tbody tr {
        width: 48%;
        max-width: 48%;
      }
    }
    @media (min-width: 1200px) {
      .dataTable.cards tbody tr {
        max-width: 31.333%;
        width: 31.333%;
      }
    }

    @media (max-width: 480px) {
      .dataTable.cards .empresa {
        font-size: 15px;
      }
      .dataTable.cards .name {
        font-size: 13px;
      }
    }

</style>
<div class="row components_content">

  <div class="col">
    <div class="row px-5 pt-3">
      <div class="col">
        <h2 class="title-seccion">Videoteca</h2>

        <table class="table cards w-100" id="competitorsTb">
          <thead class="d-none">
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>URL</th>
              <th>Especialidad</th>
              <th>Tema</th>
              <th>Contenido</th>
              <th>Fecha</th>
              <th>Lugar</th>
              <th>Tipo Licencia</th>
              <th>Participantes</th>
              <th>Tags</th>
            </tr>
          </thead>
        </table>
        
      </div>
    </div>
  </div>
</div>



@section('javascript')
<script type="text/javascript">
  competitorsTb = $('#competitorsTb').DataTable({
     processing: true,
     serverSide: true,
     ajax: "{{route('videos.list')}}",
     pageLength: 3,
     lengthMenu: [ 3, 15, 30, 50, 100 ],
     columns: [
		{ data: "id", class: 'text-center d-none'},
		{ data: "name", class: 'text-left'},
		{ data: "description", class: 'text-left'},
		{ data: "url", class: 'text-left py-0'},
		/*

    { data: "especialidad", class: 'text-left'},
		{ data: "tema", class: 'text-left'},
		{ data: "contenido", class: 'text-left'},
		{ data: "fecha", class: 'text-left'},
		{ data: "lugar", class: 'text-left'},
		{ data: "tipo_licencia", class: 'text-left'},
		{ data: "competitors", class: 'text-left'},
		{ data: "tags", class: 'text-left'},
    */
    
    ],
    "createdRow": function( row, data, dataIndex){
      $(row).addClass('card card-body');
    },
    order: [[ 0, "desc" ]],
    language: dLanguage
  });
</script>
@endsection

