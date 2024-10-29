<html lang="en">
    <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <meta http-equiv="X-UA-Compatible" content="ie=edge">
       <title>Document</title>
       <link rel="stylesheet" href="{{ asset('css/formulir.css') }}">
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body class="body">
       @extends('navbar/nav-Poin')
       
       @section('content')
       <p class="text-center">FORMULIR EDIT DATA POIN</p>
       <div class="container">
           <form method="POST" action="{{ route('poinUpdate', $poinPeringatan['id_peringatan']) }}">
              @csrf
              @method('PUT')
              <div class="form-row">
                  <label for="peringatan">Peringatan</label>
                  <input type="text" name="peringatan" value="{{ $poinPeringatan['peringatan'] }}" class="form-control">
              </div>

               <div class="form-row">
                   <label for="max_poin">Poin Lengkap</label>
                   <input type="text" name="max_poin" value="{{ $poinPeringatan['max_poin'] }}" class="form-control">
               </div>
   
               <div class="button-group">
                   <button type="button" class="btn-dua" onclick="window.location.href='{{ route('HalamanPoin') }}';">Kembali</button>
                   <button type="submit" class="btn-satu" >Perbaharui</button>
               </div>
           </form>
       </div>
       @endsection
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>