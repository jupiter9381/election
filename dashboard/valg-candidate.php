<form id="voteForm" class="form-horizontal">

  <section class="form-group">
    <label for="fakultet" class="cols-sm-2 control-label">Candidate List</label>
    <section class="cols-sm-10">
      <section class="input-group">
        <select class="form-control" name="candidateid" id="candidateid">
        </select>
        <!-- <input type="text" class="form-control" name="fakultet" id="fakultet" placeholder="Enter Fakultet" /> -->
      </section>
    </section>
  </section>
  <section class="form-group">
    <label for="enavn" class="cols-sm-2 control-label">Start Suggestion</label>
    <section class="cols-sm-10">
      <section class="input-group">
        <input type="date" class="form-control" name="startforslag" id="startforslag" value="<?php echo date('Y-m-d');?>"/>
      </section>
    </section>
  </section>
  <section class="form-group">
    <label for="enavn" class="cols-sm-2 control-label">End Suggestion</label>
    <section class="cols-sm-10">
      <section class="input-group">
        <input type="date" class="form-control" name="sluttforslag" id="sluttforslag" value="<?php echo date('Y-m-d');?>"/>
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