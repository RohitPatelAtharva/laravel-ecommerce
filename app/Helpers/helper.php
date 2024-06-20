 <?php

  use App\Mail\OrderEmail;
  use App\Models\Category;
  use Illuminate\Support\Facades\Auth;
  use App\Models\Cart;
  use App\Models\Country;
  use App\Models\Order;
  use App\Models\Product;
  use App\Models\Product_image;
  use Illuminate\Support\Facades\Mail;

  function getCategories()
  {
    return Category::orderBy('name', 'ASC')->with('sub_category')->where('status', 1)->where('showHome', 'Yes')->get();
  }
  function getProductImage($productId)
  {
    return Product_image::where('product_id', $productId)->first();
  }


  function orderEmail($orderId,$userType="customer")
  {
    $order = Order::where('id', $orderId)->with('items')->first();
    if($userType=='customer'){
   $subject='Thanks for your order ';
   $email=$order->email;
    }else{
      $subject='You have recieve an order';
      $email=env('ADMIN_EMAIL');
    }

    $mailData = [
      'subject' => $subject,
      'order' => $order,
      'userType'=>$userType
    ];
    Mail::to($email)->send(new OrderEmail($mailData));
  }

  function getCountryInfo($id)
  {
    return Country::where('id', $id)->first();
  }






  ?>
