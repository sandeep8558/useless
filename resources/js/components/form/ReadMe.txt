Step By Step Guid

* Make Model "Demo"

* Create Migration for Demo Model

* Use following Migration Setup
    Schema::create('demos', function (Blueprint $table) {
        $table->id();
        $table->string('full_name')->nullable();
        $table->string('password')->nullable();
        $table->text('message')->nullable();
        $table->string('gender')->nullable();
        $table->string('priority')->nullable();
        $table->text('books')->nullable();
        $table->text('photo')->nullable();
        $table->text('media')->nullable();
        $table->timestamps();
    });

* Migrate Migration

* Load Demo Component anywhere you want to use.