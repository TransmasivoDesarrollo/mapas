<x-app-layout>
<style type="text/css">
  
  .banner{
    position: relative;
    width: 100%;
    height: calc(95vh - 50px);
    background-color: #F5F5F5;
    background-size:cover; 
    background-position: center;
    transition: all .1s ease-in-out;
    background-image: url('images/banner/banner1.jpg');
    animation: banner 60s  infinite linear;
  }
  .banner-content{
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    color:#FFF;
    background-color: rgba(0,0,0,.6); 
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }
  .banner-content h1{
    margin: 0;
    padding: 0;
    padding-bottom: 30px;
    font-size: 40px;
    text-align: center;
  }
  @keyframes banner{
    0%{
      background-image: url('images/Volvo-Mexibus-2.jpg');
    }
    25%{
      background-image: url('images/Volvo-Mexibus1.jpg');
    }
    50%{
      background-image: url('images/newMEXIBUS 53 ROSA.jpg');
    }
    75%{
      background-image: url('images/Volvo-Mexibus1.jpg');
    }
    100%{
      background-image: url('images/newMEXIBUS 53 ROSA.jpg');
    }

  }
</style>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
        <section class="banner">
          <div class="banner-content">
            <h1>Bienvenido</h1>
            <h1><b>SISTEMA INTEGRAL TRANSMASIVO</b></h1>
          </div>
          
        </section>
      </div>
    </div>
  </div>
</div>
        

@section('jscustom')

@endsection

</x-app-layout>
