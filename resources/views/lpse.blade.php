<!doctype html>
<html lang="en">
  <head>
    @include('includes.headform')
    <title>Layanan PSE</title>
  </head>
  <body>
    <div class="container contact col-sm-10">
    <a href="{{ route('home') }}">
      <button type="button" class="btn btn-primary btn-back bg-transparent"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</button>
    </a>
        <div class="row">
            <div class="col-md-3">
                <div class="contact-info">
                    <img src="{{ asset('assets/logo-pse-putih.png') }}" style="margin-bottom:40px !important; text-align:center; height:80%; width:80%; justify-content:center; content-align: center; margin: auto; display:flex;" alt="image"/>
                    <h2>Layanan PSE</h2>
                    <h4>Mohon isi form berikut terlebih dahulu</h4>
                </div>
            </div>
            <div class="col-md-9">
                <div class="contact-form">
                  
                  @if (session('error'))
                      <div class="alert alert-warning">
                          {{ session('error') }}
                      </div>
                  @endif

                    {!! Form::open(['url' => "layanan-lpse/upload-data-layanan-lpse", 'method' => 'post', 'class' => 'needs-validation', 'enctype' => 'multipart/form-data' ]) !!}
                    @csrf

                    <div class="form-group">
                        <p>
                            <h3 class="judulpse">Langkah Pengajuan Layanan PSE</h3>
                            Untuk Layanan PSE, silahkan download dan lengkapi formulir berikut terlebih dahulu. <br>
                            Setelah itu isi form dibawah dan upload formulir PSE yang sudah dilengkapi
                        </p>
                    </div>                    

                    <div class="form-group">  
                      <a download href="{{ asset('assets/Formulir-Pendaftaran-Sistem-Elektronik.docx') }}">
                        {{Form::label('fpse', 'Klik untuk Download Formulir',['class' => 'control-label downlpse col-sm-12'])}}
                      </a>
                    </div>

                    <hr>


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
                        {{Form::text('fNo_HP', '', ['class' => 'form-control', 'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');", 'placeholder' => 'Masukkan nomor telepon', 'name' => 'fno_hp', 'required' ])}}
                        <div class="invalid-feedback">Mohon untuk menginputkan nomor telepon.</div>
                      </div>
                    </div>

                    <div class="form-group">
                        {{Form::label('fLPSE', 'Formulir PSE yang sudah dilengkapi: ', ['class' => 'control-label col-sm-10'])}}
                        <div class="col-sm-10">
                          {{Form::file('fLPSE', ['class' => 'form-control-file', 'name' => 'fLPSE', 'accept' =>'.docx, .pdf, image/*', 'required'])}}
                          <div class="invalid-feedback">Mohon untuk mengupload formulir PSE</div>
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
