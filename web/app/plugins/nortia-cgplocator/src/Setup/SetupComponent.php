<?php
namespace NortiaCGPLocator\Setup;

class SetupComponent
{
    public function __construct() {
        new EnqueueAssets;
        new ActivatePlugin;
        new DeactivatePlugin;
    }
}