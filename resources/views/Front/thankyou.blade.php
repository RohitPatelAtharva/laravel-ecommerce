@extends('Front.app')

@section('content')
<style>
.card-custom {
  border: none;
  background-color: #f8f9fa;
  margin-bottom: 20px;
}
.card-header-custom {
  background-color: #fff;
  padding: 20px;
  border-bottom: 1px solid #dee2e6;
}
.card-body-custom {
  padding: 20px;
}
.confirmation-icon {
  width: 50px;
  height: 50px;
  margin-bottom: 20px;
}
.btn-custom {
  background-color: #ff3366;
  color: white;
  border: none;
  padding: 10px 20px;
  font-size: 18px;
}
.order-details-icon {
  width: 60px;
  height: 60px;
}
.delivery-info {
  display: flex;
  align-items: center;
}
.delivery-details {
  margin-left: 15px;
}
.alert-custom {
  display: flex;
  align-items: center;
  background-color: #fff;
  border: 1px solid #dee2e6;
  padding: 10px;
  margin-top: 10px;
}
.alert-custom svg {
  margin-right: 10px;
}
.highlight {
  color: #ff3366;
}
.promo-offer img {
  width: 100%;
}
</style>

<section class="container">
        <div class="col-md-12 text-center py-5">
            @if(Session::has('success'))
            <div class="alert alert-success">
              {{Session::get('success')}}
            </div>
            @endif
            <h1>Thank You</h1>
            <p>Your Order Id  is:{{$id}}</p>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100" height="100" fill="#28a745">
              <path d="M0 0h24v24H0V0z" fill="none"/>
              <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5L5.71 12.3a.996.996 0 0 1 0-1.41l1.41-1.41a.996.996 0 0 1 1.41 0L11 13.17l6.47-6.47a.996.996 0 0 1 1.41 0l1.41 1.41a.996.996 0 0 1 0 1.41L13 16.9l-3-3z"/>
          </svg>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100" height="100" fill="#007bff">
              <path d="M21.12 11.46l-1.59-1.58c-.03-.03-.06-.05-.09-.07l-1.92-1.92c-.02-.02-.04-.04-.07-.06l-1.58-1.59c-.09-.09-.21-.14-.33-.14h-7c-.35 0-.67.21-.81.53L4.3 4.71c-.14.33-.46.53-.81.53H2c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1h1v6c0 .55.45 1 1 1h2c.55 0 1 .45 1 1s.45 1 1 1h10c.55 0 1-.45 1-1s.45-1 1-1h2c.55 0 1-.45 1-1v-6h1c.55 0 1-.45 1-1v-1.12c0-.13-.05-.25-.14-.34zM4 6h2c.1 0 .19-.04.28-.12L7.1 4H8v3H4V6zm16 12h-6v-6h6v6zm0-7h-5v-2h5v2zm-7 0H9V9h4v2zm7 7h-6v-6h6v6z"/>
            </svg>
        </div>
</section>
 <div class="container mt-5">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <!-- Order Confirmation Card -->
          <div class="card card-custom">
              <div class="card-header-custom text-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#03A685" viewBox="0 0 16 16" class="confirmation-icon"><path fill-rule="nonzero" d="M7.59 0l1.195 1.72 1.72-1.104.465 2.06 2.005-.34-.325 2.103 1.964.488-1.053 1.805L15.2 7.985l-1.64 1.253 1.053 1.806-1.964.488.325 2.102-2.005-.34-.465 2.06-1.72-1.104-1.194 1.7-1.194-1.72-1.721 1.103-.466-2.038-2.003.34.323-2.103-1.963-.488 1.052-1.806L0 7.985l1.64-1.253L.566 4.927 2.53 4.44l-.323-2.102 2.003.339.466-2.06 1.72 1.104L7.591 0zm1.768 6.12L6.687 9.007a.045.045 0 0 1-.067 0L5.64 7.955a.358.358 0 0 0-.53 0 .417.417 0 0 0 0 .564l1.283 1.37c.07.075.165.112.265.112h.002c.1 0 .195-.039.265-.115l2.97-3.208a.417.417 0 0 0-.007-.563.358.358 0 0 0-.529.006z"></path></svg>
                  <h4 class="font-weight-bold">Order Confirmed</h4>
              </div>
              <div class="card-body-custom">
                  <h5 class="font-weight-bold">Delivering to:</h5>
                  <div class="delivery-info mt-3 p-3 bg-light rounded">
                      <div>
                          <div class="font-weight-bold">ROHIT PATEL | 9696573419</div>
                          <div>Rajatalab, odar, Varanasi, Uttar Pradesh- 221311</div>
                      </div>
                      <img class="order-details-icon" src="https://constant.myntassets.com/checkout/assets/img/delhiveryPerson_17-03-2021.png" alt="Delivery Person">
                  </div>
                  <a class="btn btn-link" href="/my/item/details?storeOrderId=126997768909521775701">ORDER DETAILS <svg xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12" class="confirmation-icon"><path fill-rule="evenodd" d="M6.797 5.529a.824.824 0 0 0-.042-.036L1.19.193a.724.724 0 0 0-.986 0 .643.643 0 0 0 0 .94L5.316 6 .203 10.868a.643.643 0 0 0 0 .938.724.724 0 0 0 .986 0l5.566-5.299a.644.644 0 0 0 .041-.978"></path></svg></a>
                  <div class="alert alert-custom mt-4">
                      <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><g clip-path="url(#clipMagicWand)" fill="#282C3F"><path d="M15.328.672a.312.312 0 10-.442.441.312.312 0 00.442-.44zM15.328 9.51a.313.313 0 10-.442.443.313.313 0 00.442-.442zM6.49.672a.312.312 0 10-.443.441.312.312 0 00.442-.44zM11.957 4.485l-.442-.442a.939.939 0 00-1.326 0L.275 13.958a.937.937 0 000 1.325l.442.442a.937.937 0 001.325 0l9.915-9.914a.938.938 0 000-1.326zM1.6 15.283a.312.312 0 01-.441 0l-.442-.441a.312.312 0 010-.442L8.2 6.916l.883.883L1.6 15.283zm9.915-9.914L9.526 7.357l-.883-.883 1.988-1.989a.311.311 0 01.442 0l.442.442a.313.313 0 010 .442zM7.563 5H5.688a.312.312 0 100 .625h1.875a.312.312 0 100-.625zM15.688 5h-1.876a.312.312 0 100 .625h1.876a.312.312 0 100-.625zM10.688 8.125a.312.312 0 00-.313.313v1.874a.312.312 0 10.625 0V8.438a.312.312 0 00-.312-.313zM10.688 0a.312.312 0 00-.313.313v1.875a.312.312 0 10.625 0V.312A.312.312 0 0010.688 0zM14.444 8.627L13.118 7.3a.313.313 0 00-.442.442l1.326 1.326a.312.312 0 00.442 0 .313.313 0 000-.442zM8.699 2.882L7.373 1.556a.313.313 0 00-.442.442l1.326 1.326a.313.313 0 00.442-.442zM14.444 1.556a.313.313 0 00-.442 0l-1.326 1.326a.313.313 0 00.442.442l1.326-1.326a.313.313 0 000-.442z"></path></g><defs><clipPath id="clipMagicWand"><path fill="#fff" d="M0 0H16V16H0z"></path></clipPath></defs></svg>
                      <div>
                          <div><strong>Get instant refund on order cancellation</strong></div>
                          <div>Amount will be added to your Myntra Credit</div>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Promo Offer Card -->
          <div class="card card-custom">
              <div class="card-body-custom">
                  <img src="https://constant.myntassets.com/checkout/assets/img/delivery-banner-11.jpg" alt="Promo Offer">
              </div>
          </div>
      </div>
  </div>
</div>


@endsection