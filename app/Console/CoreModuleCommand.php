<?php

namespace App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CoreModuleCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The systems will create module with name you entered';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $module = ucfirst($this->argument('name'));

        if (!file_exists(base_path("modules/{$module}"))) {
            mkdir(base_path("modules/{$module}"), 0777, true);
            $this->config($module);
            $this->http($module);
            $this->model($module);

            mkdir(base_path("modules/" . ucfirst($module) . "/Migrations"), 0777, true);
        }
        $migrationPath = "modules/" . ucfirst($module) ."/Migrations";
        Artisan::call('make:migration create_'.strtolower($module).'s_table --create='.strtolower($module).'s --path='. $migrationPath);

        $this->info("Module {$module} has been created");
    }

    /**
     * Generate Config
     * @param $module
     */
    protected function config($module)
    {
        mkdir(base_path("modules/{$module}/Configs"), 0777, true);
        //menu
        $content = "<?php
return [
    'name' => trans('" . $module . "'),
    'route' => route('get." . strtolower($module) . ".list'),
    'sort' => 1,
    'active'=> TRUE,
    'id'=> '".strtolower($module)."',
    'icon' => '',
    'middleware' => [],
    'group' => []
];";
        $fp = fopen(base_path("modules/{$module}/Configs/menu.php"), "wb");
        fwrite($fp, $content);
        fclose($fp);

        //permission

        $content = "<?php
return [
    'name' => '" . strtolower($module) . "',
    'display_name' => trans('" . ucfirst($module) . "'),
    'group' => []
];";
        $fp = fopen(base_path("modules/{$module}/Configs/permission.php"), "wb");
        fwrite($fp, $content);
        fclose($fp);
    }

    /**
     * Generate Model
     * @param $module
     */
    protected function model($module)
    {
        mkdir(base_path("modules/{$module}/Models"), 0777, true);
        $content = '<?php

namespace Modules\\' . $module . '\\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ' . $module . ' extends Model
{
    use SoftDeletes;

    protected $table = "' . strtolower($module) . 's";

    protected $primaryKey = "id";

    protected $dates = ["deleted_at"];

    protected $guarded = [];

    public $timestamps = true;


}
';
        $fp = fopen(base_path("modules/{$module}/Models/{$module}.php"), "wb");
        fwrite($fp, $content);
        fclose($fp);
    }

    /**
     * Generate Http folder
     * @param $module
     */
    protected function http($module)
    {
        // Controller
        mkdir(base_path("modules/{$module}/Controllers"), 0777, true);
        $content = '<?php

namespace Modules\\' . $module . '\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\\'.$module.'\Models\\'.$module.';

class ' . $module . 'Controller extends Controller{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        # parent::__construct();
    }

    public function index(Request $request){
        $data = ' . $module . '::query()->orderBy("name")->paginate(20);

        return view("' . $module . '::index", compact("data"));
    }
}
';
        $fp = fopen(base_path("modules/{$module}/Controllers/{$module}Controller.php"), "wb");
        fwrite($fp, $content);
        fclose($fp);
        /************************************************************************************/

        //Validation
        mkdir(base_path("modules/{$module}/Requests"), 0777, true);
        $content = '<?php

namespace Modules\\' . $module . '\Requests;

use App\AppHelpers\Helper;
use Illuminate\Foundation\Http\FormRequest;

class ' . $module . 'Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $method = segmentUrl(2);
        switch ($method) {
            default:
                return [];
                break;
            case "update":
                return [];
                break;
        }
    }

    public function messages()
    {
        return [];
    }

    public function attributes()
    {
        return [];
    }
}
';

        $fp = fopen(base_path("modules/{$module}/Requests/{$module}Request.php"), "wb");
        fwrite($fp, $content);
        fclose($fp);

        /*****************************************************************************************/

        //Route
        mkdir(base_path("modules/{$module}/Routes"), 0777, true);

        $content = '<?php
use Illuminate\Support\Facades\Route;

Route::prefix("' . strtolower($module) . '")->group(function (){
    Route::get("/", "' . $module . 'Controller@index")->name("get.' . strtolower($module) . '.list");
});
';
        $fp = fopen(base_path("modules/{$module}/Routes/admin.php"), "wb");
        fwrite($fp, $content);
        fclose($fp);

        $content2 = '<?php
use Illuminate\Support\Facades\Route;
';
        $fp = fopen(base_path("modules/{$module}/Routes/web.php"), "wb");
        fwrite($fp, $content2);
        fclose($fp);

    }
}
