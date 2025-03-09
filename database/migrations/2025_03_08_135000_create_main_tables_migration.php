<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainTablesMigration extends Migration {
//Type_person_model 
		Schema::create('type_person', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name',100);
			$table->boolean('status')->default(1);

			$table->timestamps();
		});

	}
	public function down()
	{
		Schema::dropIfExists('type_person');

	}
//Person_model 
		Schema::create('person', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('email',100);
			$table->string('password',100);
			$table->unsignedBigInteger('type_id');
			$table->foreign('type_id')->references('id')->on('Type_person');
			$table->string('username',100);
			$table->boolean('status')->default(1);

			$table->timestamps();
		});

	}
	public function down()
	{
		Schema::dropIfExists('person');

	}
//Category_product_model 
		Schema::create('category_product', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name',100);
			$table->boolean('status')->default(1);

			$table->timestamps();
		});

	}
	public function down()
	{
		Schema::dropIfExists('category_product');

	}
//Store_model 
		Schema::create('store', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name',100);
			$table->string('address',100);
			$table->unsignedBigInteger('seller');
			$table->foreign('seller')->references('id')->on('Person');
			$table->boolean('status')->default(1);

			$table->timestamps();
		});

	}
	public function down()
	{
		Schema::dropIfExists('store');

	}
//Product_model 
		Schema::create('product', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name',100);
			$table->unsignedBigInteger('category');
			$table->foreign('category')->references('id')->on('Category_product');
			$table->unsignedBigInteger('Store_id');
			$table->foreign('Store_id')->references('id')->on('Store');
			$table->integer('stock');
			$table->float('price', 8, 2);
			$table->string('description',100);
			$table->boolean('status')->default(1);

			$table->timestamps();
		});

	}
	public function down()
	{
		Schema::dropIfExists('product');

	}
//Cart_model 
		Schema::create('cart', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('quantity');
			$table->unsignedBigInteger('Product_id');
			$table->foreign('Product_id')->references('id')->on('Product');
			$table->unsignedBigInteger('Person_id');
			$table->foreign('Person_id')->references('id')->on('Person');
			$table->boolean('status')->default(1);

			$table->timestamps();
		});

	}
	public function down()
	{
		Schema::dropIfExists('cart');

	}
//Orders_model 
		Schema::create('orders', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('Person_id');
			$table->foreign('Person_id')->references('id')->on('Person');
			$table->boolean('status')->default(1);

			$table->timestamps();
		});

	}
	public function down()
	{
		Schema::dropIfExists('orders');

	}
//Orders_products_model 
		Schema::create('orders_products', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('order_id');
			$table->foreign('order_id')->references('id')->on('Orders');
			$table->unsignedBigInteger('Product_id');
			$table->foreign('Product_id')->references('id')->on('Product');
			$table->integer('quantity');
			$table->float('price', 8, 2);
			$table->float('total', 8, 2);
			$table->boolean('status')->default(1);

			$table->timestamps();
		});

	}
	public function down()
	{
		Schema::dropIfExists('orders_products');

	}

}
