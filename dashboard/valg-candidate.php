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
    <label for="fakultet" class="cols-sm-2 control-label">Election List</label>
    <input type="hidden" name="startvalg" id="startvalg">
    <input type="hidden" name="sluttvalg" id="sluttvalg">
    <input type="hidden" name="informasjon" id="information">
    <section class="cols-sm-10">
      <section class="input-group">
        <select class="form-control" name="electionid" id="electionid">
        </select>
      </section>
    </section>
  </section>
  <section class="form-group ">
    <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Submit</button>
  </section>
</form>
<script type="text/javascript" src="../assets/js/vote.js"></script>