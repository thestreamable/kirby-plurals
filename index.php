<?php

use Kirby\Toolkit\Str;
use Kirby\Toolkit\I18n;
use const Oblik\Pluralization\LANGUAGES;

function tp($key, array $data, $locale = null)
{
    $lc = $locale ?? I18n::locale();
    $map = option('oblik.plurals.map');

    if (is_array($map) && !empty($map[$lc])) {
        $lc = $map[$lc];
    }

    $pluralizer = LANGUAGES[$lc] ?? null;

    if ($pluralizer) {
        if (isset($data['count'])) {
            $form = $pluralizer::getCardinal($data['count']);
        } else if (isset($data['position'])) {
            $form = $pluralizer::getOrdinal($data['position']);
        } else if (isset($data['start']) && isset($data['end'])) {
            $form = $pluralizer::getRange($data['start'], $data['end']);
        }

        if (isset($form)) {
            $allTranslations = I18n::translation($locale);
            
            $resolveTranslation = function ($form) use ($key, $pluralizer, $allTranslations): ?string {
                $formName = $pluralizer::formName($form);
                
                return $allTranslations[$key][$formName] ?? $allTranslations[$key . ".$formName"] ?? null;
            };
            
            $translation = null;
            if (isset($data['count']) && $data['count'] == 0) {
                // Special case for count=0, even if language doesn't require it.
                $translation = $resolveTranslation(Oblik\Pluralization\ZERO);
            }
            
            if (!$translation) {
                $translation =  $resolveTranslation($form)                          // try to use correct form
                                ?: $resolveTranslation(Oblik\Pluralization\OTHER)   // OTHER form as fallback
                                ?: ($allTranslations[$key] ?? null);                // use as standard string
            }

            if (is_string($translation)) {
                return Str::template($translation, $data);
            }
        }
    }

    $fallback = I18n::fallback();

    if ($fallback !== $locale) {
        return tp($key, $data, $fallback);
    } else {
        return null;
    }
}
