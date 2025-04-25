<?php /** @noinspection PhpInconsistentReturnPointsInspection */

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use function Laravel\Prompts\search;

class AutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($num = null)
    {

        if (!session()->has('auto')) {
            session(['auto' => '0']);
        }

        if (empty($num) && !session()->has('num')) {
            return redirect()->route('index');
        }

        if (!session()->has('num')) {
            session(['num' => $num]);
        }

        $auto = session('auto');
        $num = session('num');
        $auto++;
        session(['auto' => $auto]);
        switch ($auto) {
            case 1:
                return redirect()->route('cu', ['num' => $num]);
            case 2:
                return redirect()->route('ct', ['num' => $num]);
            case 3:
                return redirect()->route('cc', ['num' => $num]);
            case 4:
                return redirect()->route('cct');
            default:
                session()->forget('num');
                session()->forget('auto');
                return redirect()->route('index');
        }
    }
}
