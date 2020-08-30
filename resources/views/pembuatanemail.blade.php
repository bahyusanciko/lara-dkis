<!doctype html>
<html lang="en">
  <head>
    @include('includes.headform')
    <title>Pengajuan Pembuatan Email</title>
  </head>
  <body>
    <div class="container contact col-sm-10">
    <a href="{{ route('home') }}">
      <button type="button" class="btn btn-primary btn-back bg-transparent"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button>
    </a>
        <div class="row">
            <div class="col-md-3">
                <div class="contact-info">
                    <i class="fas fa-at" style="font-size:  62px;"></i>
                    <br><br>
                    <h2>Pengajuan Pembuatan Email</h2>
                    <h4>Mohon isi form berikut terlebih dahulu</h4>
                </div>
            </div>
            <div class="col-md-9">
                <div class="contact-form">
                    {!! Form::open(['url' => 'layanan-email/upload-data-email', 'method' => 'post', 'class' => 'needs-validation', 'novalidate', 'enctype' => 'multipart/form-data' ]) !!}
                    @csrf
                    <div class="form-group">
                      {{Form::label('fnama', 'Nama lengkap:',['class' => 'control-label col-sm-6'])}}
                      <div class="col-sm-10">
                        {{ Form::text('fnama', $val->nama, ['class' => 'form-control', 'placeholder' => 'Masukkan nama lengkap', 'name' => 'fnama', 'readonly', 'required']) }}
                        <div class="invalid-feedback">Mohon untuk menginputkan nama lengkap.</div>
                      </div>
                    </div>

                    <div class="form-group">
                      {{Form::label('fNIP', 'NIP:', ['class' => 'control-label col-sm-6'])}}
                      <div class="col-sm-10">
                        {{Form::text('fNIP', $val->nip, ['class' => 'form-control', 'placeholder' => 'Masukkan NIP anda', 'name' => 'fnip', 'readonly', 'required' ])}}
                        <div class="invalid-feedback">Mohon untuk menginputkan NIP.</div>
                      </div>
                    </div>

                    <div class="form-group">
                      {{Form::label('fNo_HP', 'Nomor Telepon:', ['class' => 'control-label col-sm-6'])}}
                      <div class="col-sm-10">
                        {{Form::text('fNo_HP', $val->no_hp, ['class' => 'form-control', 'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');", 'placeholder' => 'Masukkan nomor telepon', 'name' => 'fno_hp', 'required' ])}}
                        <div class="invalid-feedback">Mohon untuk menginputkan nomor telepon.</div>
                      </div>
                    </div>

                    <div class="form-group">
                      {{Form::label('SKPD', 'SKPD:', ['class' => 'control-label col-sm-6'])}}
                      <div class="col-sm-10">
                        {{Form::text('SKPD', '', ['class'=>'form-control', 'placeholder' => 'Masukkan nama SKPD', 'name' => 'SKPD', 'required'])}}
                        <div class="invalid-feedback">Mohon untuk menginputkan nama SKPD.</div>
                      </div>
                    </div>

                    <div class="form-group">
                      {{Form::label('fsurat_permohonan', 'Surat Permohonan yang sudah dilengkapi: ', ['class' => 'control-label col-sm-10'])}}
                      <div class="col-sm-10">
                        {{Form::file('fsurat_permohonan', ['class' => 'form-control-file', 'name' => 'fsurat_permohonan', 'accept' =>'.docx, .pdf', 'required'])}}
                        <div class="invalid-feedback">Mohon untuk mengupload Surat Permohonan Akun</div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                      {{Form::submit('Konfirmasi', ['class'=>'btn btn-primary', 'style'=>'width:45%; background-color:#1f317f !important' ])}}
                      </div>
                    </div>
                  {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script>
      // Disable form submissions if there are invalid fields
      (function() {
        'use strict';
        window.addEventListener('load', function() {
          // Get the forms we want to add validation styles to
          var forms = document.getElementsByClassName('needs-validation');
          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>

  </body>
</html>
