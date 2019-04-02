@extends('frontend.template.layout')
@section('title') <?= $title; ?> @stop
@section('content')

<?php use App\Http\Controllers\Frontend\IndexController; ?>
<?php use Illuminate\Support\Collection; ?>
<main id="main">
   <!-- breadcrumb nav -->
   <nav class="breadcrumb-nav">
      <div class="container">
         <!-- breadcrumb -->
         <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Login</li>
         </ol>
      </div>
   </nav>
   <!-- two columns -->
   <div id="two-columns" class="container">
      <div class="row">
         <!-- content -->
         <article id="content" class="col-xs-12 col-md-12">
            <!-- content h1 -->
            <h1 class="content-h1 fw-semi">Login</h1>
            <!-- view header -->
            <header class="view-header row">
               <div class="col-xs-12 col-sm-12 d-flex">
                  <div class="col-xs-12 col-md-12">
                     <!-- user log form -->
                        @if(session()->has('message'))
                            <div class="alert alert-info">
                                {!! session()->get('message') !!}
                            </div>
                        @endif
                     <form method="post" action="/frontend/login_check" class="user-log-form">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <h2>Login Form</h2>
                        <div class="form-group">
                           <input value="{{ old('email') }}" name="email" type="email" class="form-control element-block" placeholder="Email address *" required>
                        </div>
                        <div class="form-group">
                           <input title="6 characters Minimum" minlength="6" name="password" type="password" class="form-control element-block" placeholder="Password *" required>
                        </div>
                        <div class="btns-wrap">
                           <div class="wrap">
                              <button type="submit" class="btn btn-theme btn-warning fw-bold font-lato text-uppercase">Login</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </header>
         </article>
      </div>
   </div>
</main>
@stop