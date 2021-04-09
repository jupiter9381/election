<form id="electionForm" class="form-horizontal">
  <section class="form-group">
    <label for="enavn" class="cols-sm-2 control-label">Title</label>
    <section class="cols-sm-10">
      <section class="input-group">
        <input type="text" class="form-control" name="title" id="title" placeholder="Enter title "/>
      </section>
    </section>
  </section>

  <section class="form-group">
    <label for="enavn" class="cols-sm-2 control-label">Start Election</label>
    <section class="cols-sm-10">
      <section class="input-group">
        <input type="date" class="form-control" name="startvalg" id="startvalg" value="<?php echo date('Y-m-d');?>"/>
      </section>
    </section>
  </section>
  <section class="form-group">
    <label for="enavn" class="cols-sm-2 control-label">End Election</label>
    <section class="cols-sm-10">
      <section class="input-group">
        <input type="date" class="form-control" name="sluttvalg" id="sluttvalg" value="<?php echo date('Y-m-d');?>"/>
      </section>
    </section>
  </section>
  <section class="form-group">
    <label for="informasjon" class="cols-sm-2 control-label">Informasjon</label>
    <section class="cols-sm-10">
      <section class="input-group">
        <textarea type="text" class="form-control" name="informasjon" id="informasjon" placeholder="Enter Informasjon" rows="4" style="resize: none;"/></textarea>
      </section>
    </section>
  </section>
  <section class="form-group ">
    <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Submit</button>
  </section>
</form>
<script type="text/javascript" src="../assets/js/vote.js"></script>