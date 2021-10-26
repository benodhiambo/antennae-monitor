<?php

namespace App\Http\Controllers;

use App\AcceptanceReport;
use App\InstallationReport;
use App\Site;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function showSummaryPage()
    {
        $siteData = Site::get(['site_id']);
        $regions = $this->getRegionsArray($siteData);
        $siteCount = $this->getSiteCountPerRegion($regions);
        return view('sites.summary', compact('siteCount'));
    }

    private function getRegionsArray($sites)
    {
        $regionsArray = array();
        foreach ($sites as $data) {
            $id = $data->site_id;
            //digit on the first part of the id
            $siteIdNo = substr($id, 0, strpos($id, '_'));

            //remove the digits on the left side of region identifier
            $name = str_replace($siteIdNo."_","", $data->site_id);

            // get characters after the region identifier
            $last = substr($name, strpos($name, '_'));

            //remove the characters after the rgion identifier
            $name = str_replace($last,"", $name);

            //Add name to regions array
            array_push($regionsArray, $name);
        }
        $regionsArray = array_values(array_unique($regionsArray));
        return $regionsArray;
    }

    private function getSiteCountPerRegion($regions)
    {
        $siteCount = array();
        foreach ($regions as $region) {
            $siteCount[$region]['name'] = $region;
            $siteCount[$region]['scoped'] = $this->getScopedSiteCount($region);
            $siteCount[$region]['comissioned'] = $this->getComissionedSiteCount($region);
            $siteCount[$region]['planned'] = $this->getPlannedSiteCount($region);
            $siteCount[$region]['installed'] = $this->getInstalledSites($region);
            $siteCount[$region]['scheduled'] = $this->getScheduledSiteCount($region);
            $siteCount[$region]['accepted'] = $this->getAcceptedSiteCount($region);
            $siteCount[$region]['rejected'] = $this->getRejectedSiteCount($region);
        }
        return $siteCount;
    }

    private function getScopedSiteCount($region)
    {
        return Site::where('site_id', 'LIKE', '%\_' . $region . '\_%')->count();
    }

    private function getComissionedSiteCount($region)
    {
        return 'Not Available';
    }

    private function getPlannedSiteCount($region)
    {
        return 'Not Available';
    }

    private function getInstalledSites($region)
    {
        $installedSiteIds = InstallationReport::where('installation_report', 'LIKE', '%\_' . $region . '\_%')
                                                ->where('status', 'LIKE', '%ccepted%')
                                                ->get(['id'])
                                                ->toArray();
        return count($installedSiteIds);
    }

    //sites which have been installed but have no acceptance certificate
    private function getScheduledSiteCount($region)
    {
        // Get contractor Accepted installations
        $installReportIdsOfRegion = InstallationReport::where('installation_report', 'LIKE', '%\_' . $region . '\_%')
                                                        ->where('status', 'LIKE', '%ccepted%')
                                                        ->get(['id']);

        // Get safcom accpted installations
        $acceptanceFormIds = AcceptanceReport::where('acceptance_form', 'LIKE', '%\_' . $region . '\_%')
                                                ->where('status', 'LIKE', '%ccepted%')
                                                ->get(['installation_report_id']);

        $acceptIds = array();
        foreach ($acceptanceFormIds as $id) {
            array_push($acceptIds, $id->installation_report_id);
        }

        $scheduledArray = array();
        foreach ($installReportIdsOfRegion as $id) {
            if (!in_array($id->id, $acceptIds)) {
                array_push($scheduledArray, $id);
            }
        }
        return count($scheduledArray);
    }

    private function getAcceptedSiteCount($region)
    {
        $acceptanceFormIds = AcceptanceReport::where('acceptance_form', 'LIKE', '%\_' . $region . '\_%')
                                            ->where('status', 'LIKE', '%ccepted%')
                                            ->get(['id'])
                                            ->toArray();
        return count($acceptanceFormIds);
    }

    private function getRejectedSiteCount($region)
    {
        $acceptanceFormIds = AcceptanceReport::where('acceptance_form', 'LIKE', '%\_' . $region . '\_%')
                                            ->where('status', 'LIKE', '%ejected%')
                                            ->get(['id'])
                                            ->toArray();
        return count($acceptanceFormIds);
    }
}
