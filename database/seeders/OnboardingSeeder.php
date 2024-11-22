<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Onboarding;

class OnboardingSeeder extends Seeder
{
    protected $settings = [
        [
            'sn_o' => 1,
            'screen' => 'user',
            'order' => 1,
            'title' => 'Assurance',
            'onboarding_image' => 'onboarding_image_1.jpg',
            'description' => 'Customer safety first,
Always and forever our pledge,
Your well-being, our priority,
With you every step, edge to edge.',
            'active' => 1
        ],
        [
            'sn_o' => 2,
            'screen' => 'user',
            'order' => 2,
            'title' => 'Clarity',
            'onboarding_image' => 'onboarding_image_2.jpg',
            'description' => 'Fair pricing, crystal clear,
Your trust, our promise sincere.
With us, youll find no hidden fee,
Transparency is our guarantee.',
            'active' => 1
        ],
        [
            'sn_o' => 3,
            'screen' => 'user',
            'order' => 3,
            'title' => 'Intuitive',
            'onboarding_image' => 'onboarding_image_3.jpg',
            'description' => 'Seamless journeys,
Just a tap away,
Explore hassle-free,
Every step of the way.',
            'active' => 1
        ],
        [
            'sn_o' => 4,
            'screen' => 'user',
            'order' => 4,
            'title' => 'Support',
            'onboarding_image' => 'onboarding_image_4.jpg',
            'description' => 'Embark on your journey with confidence, knowing that our commitment to your satisfaction is unwavering',
            'active' => 1
        ],
        [
            'sn_o' => 5,
            'screen' => 'driver',
            'order' => 1,
            'title' => 'Assurance',
            'onboarding_image' => 'onboarding_image_1.jpg',
            'description' => 'Customer safety first,
Always and forever our pledge,
Your well-being, our priority,
With you every step, edge to edge.',
            'active' => 1
        ],
        [
            'sn_o' => 6,
            'screen' => 'driver',
            'order' => 2,
            'title' => 'Clarity',
            'onboarding_image' => 'onboarding_image_2.jpg',
            'description' => 'Fair pricing, crystal clear,
Your trust, our promise sincere.
With us, youll find no hidden fee,
Transparency is our guarantee.',
            'active' => 1
        ],
        [
            'sn_o' => 7,
            'screen' => 'driver',
            'order' => 3,
            'title' => 'Intuitive',
            'onboarding_image' => 'onboarding_image_3.jpg',
            'description' => 'Seamless journeys,
Just a tap away,
Explore hassle-free,
Every step of the way.',
            'active' => 1
        ],
        [
            'sn_o' => 8,
            'screen' => 'driver',
            'order' => 4,
            'title' => 'Support',
            'onboarding_image' => 'onboarding_image_4.jpg',
            'description' => 'Embark on your journey with confidence, knowing that our commitment to your satisfaction is unwavering',
            'active' => 1
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $app_for = config('app.app_for');

        foreach ($this->settings as $setting) {
            if ($app_for == 'delivery') {
                // Update image path for delivery app_for
                $setting['onboarding_image'] = 'delivery_' . $setting['onboarding_image'];
                // If you need to change the file extension to .jpeg
                $setting['onboarding_image'] = str_replace('.jpg', '.jpeg', $setting['onboarding_image']);
            }

            Onboarding::updateOrCreate(
                ['sn_o' => $setting['sn_o'], 'screen' => $setting['screen']], // Ensure uniqueness by id and screen type
                $setting
            );
        }
    }
}
