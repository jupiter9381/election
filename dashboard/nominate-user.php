<form id="nominateForm" class="form-horizontal">
  <section class="card mb-20">
    <section class="card-body">
      <section class="fix-content-grid align-center">
        <section>
          <section id="profileImage" class="rounded-circle img-thumbnail avatar" style="background-image:url(../assets/images/profile/avatar.jpeg);" title="profile image"></section>
        </section>
        <section>
          <input class="mb-10" name="profileImage" type="file" onchange="readURL(this);" />
          <section class="text-left">
            <button type="button" class="btn btn-sm btn-success" onclick="resetImg()">Reset</button>
          </section>
        </section>
      </section>
    </section>
  </section>

  <section class="form-group">
    <label for="fakultet" class="cols-sm-2 control-label">Fakultet</label>
    <section class="cols-sm-10">
      <section class="input-group">
        <input type="text" class="form-control" name="fakultet" id="fakultet" placeholder="Enter Fakultet" />
      </section>
    </section>
  </section>
  <section class="form-group">
    <label for="institutt" class="cols-sm-2 control-label">Institutt</label>
    <section class="cols-sm-10">
      <section class="input-group">
        <input type="text" class="form-control" name="institutt" id="institutt" placeholder="Enter Institutt" />
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
  <section class="form-group">
    <label for="bruker" class="cols-sm-2 control-label">Kandidat Name</label>
    <section class="cols-sm-10">
      <section class="input-group">
        <input type="text" class="form-control" name="bruker" id="bruker" placeholder="Enter Kandidat Name" />
      </section>
    </section>
  </section>
  <section class="form-group">
    <label for="bruker_epost" class="cols-sm-2 control-label">Kandidat Email</label>
    <section class="cols-sm-10">
      <section class="input-group">
        <input type="email" class="form-control" name="bruker_epost" id="bruker_epost" placeholder="Enter Kandidat Email" />
      </section>
    </section>
  </section>
  <section class="form-group ">
    <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Send</button>
  </section>
</form>
<script type="text/javascript" src="../assets/js/update-profile.js"></script>