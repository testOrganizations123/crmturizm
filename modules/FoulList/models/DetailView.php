<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class FoulList_DetailView_Model extends Vtiger_DetailView_Model {


	/**
	 * Function to get the detail view links (links and widgets)
	 * @param <array> $linkParams - parameters which will be used to calicaulate the params
	 * @return <array> - array of link models in the format as below
	 *                   array('linktype'=>list of link models);
	 */
	public function getDetailViewLinks($linkParams) {
		$linkTypes = array('DETAILVIEWBASIC','DETAILVIEW');
		$moduleModel = $this->getModule();
		$recordModel = $this->getRecord();

		$moduleName = $moduleModel->getName();
		$recordId = $recordModel->getId();

		$detailViewLink = array();



		$linkModelListDetails = Vtiger_Link_Model::getAllByType($moduleModel->getId(),$linkTypes,$linkParams);
		//Mark all detail view basic links as detail view links.
		//Since ui will be look ugly if you need many basic links
		$detailViewBasiclinks = $linkModelListDetails['DETAILVIEWBASIC'];
		unset($linkModelListDetails['DETAILVIEWBASIC']);



		if(!empty($detailViewBasiclinks)) {
			foreach($detailViewBasiclinks as $linkModel) {
				// Remove view history, needed in vtiger5 to see history but not in vtiger6
				if($linkModel->linklabel == 'View History') {
					continue;
				}
				$linkModelList['DETAILVIEW'][] = $linkModel;
			}
		}
                
                //SalesPlatform.ru begin -  add PDF templates links to DetailView  from SPPDFTemplates
                
                /* Two cycles - to order */
                $pdfTemplates = new SPPDFTemplates_Module_Model();
                $availableTemplates = $pdfTemplates->getModuleTemplates($this->getModuleName(), $this->record->get('spcompany'));
                
                foreach($availableTemplates as $template) {
                    
                   /* Export PDF links */
                   $pdfTemplateLink = array(
                        'linklabel' => sprintf("%s %s", vtranslate('LBL_EXPORT_TO_PDF',$moduleName), $template->getName()),
                        'linkurl' => $recordModel->getExportPDFURL($template),
                   );
                   $linkModelList['DETAILVIEW'][] = Vtiger_Link_Model::getInstanceFromValues($pdfTemplateLink);
                }
                
                foreach($availableTemplates as $template) {
                   
                   /* Email link */
                   $sendEmailLink = array(
                        'linklabel' => sprintf("%s %s", vtranslate('LBL_SEND_MAIL_PDF', $moduleName), $template->getName()),
                        'linkurl' => 'javascript:Vtiger_Detail_Js.sendEmailPDFClickHandler(\''
                                            .$recordModel->getSendEmailPDFUrl($template).'\')',
                   );
                   $linkModelList['DETAILVIEW'][] = Vtiger_Link_Model::getInstanceFromValues($sendEmailLink);
                } 
                //SalesPlatform.ru end

		$relatedLinks = $this->getDetailViewRelatedLinks();

		foreach($relatedLinks as $relatedLinkEntry) {
			$relatedLink = Vtiger_Link_Model::getInstanceFromValues($relatedLinkEntry);
			$linkModelList[$relatedLink->getType()][] = $relatedLink;
		}

		$widgets = $this->getWidgets();
		foreach($widgets as $widgetLinkModel) {
			$linkModelList['DETAILVIEWWIDGET'][] = $widgetLinkModel;
		}

		$currentUserModel = Users_Record_Model::getCurrentUserModel();
		if($currentUserModel->isAdminUser()) {
			$settingsLinks = $moduleModel->getSettingLinks();
			foreach($settingsLinks as $settingsLink) {
				$linkModelList['DETAILVIEWSETTING'][] = Vtiger_Link_Model::getInstanceFromValues($settingsLink);
			}
		}
                
        //SalesPlatform.ru begin add templates reports
        foreach(Reports_Module_Model::getTemplatesReportModels($moduleName) as $reportModel) {
            $linkModelList['DETAILVIEW'][] = Vtiger_Link_Model::getInstanceFromValues(array(
                'linklabel' => vtranslate('SINGLE_Reports', 'Reports') . ' «' .$reportModel->getName() . '»',
                'linkurl' => $reportModel->getDetailViewUrl() . '&report_record_id=' . $recordId,
            ));
        }
        //SalesPlatform.ru end
                
		return $linkModelList;
	}

	/**
	 * Function to get the detail view related links
	 * @return <array> - list of links parameters
	 */
	public function getDetailViewRelatedLinks() {
		$recordModel = $this->getRecord();
		$moduleName = $recordModel->getModuleName();
		$parentModuleModel = $this->getModule();
		$relatedLinks = array();

		if($parentModuleModel->isSummaryViewSupported()) {
			$relatedLinks = array(array(
				'linktype' => 'DETAILVIEWTAB',
				'linklabel' => vtranslate('SINGLE_' . $moduleName, $moduleName) . ' ' . vtranslate('LBL_SUMMARY', $moduleName),
				'linkKey' => 'LBL_RECORD_SUMMARY',
				'linkurl' => $recordModel->getDetailViewUrl() . '&mode=showDetailViewByMode&requestMode=summary',
				'linkicon' => ''
			));
		}


		$modCommentsModel = Vtiger_Module_Model::getInstance('ModComments');
		if($parentModuleModel->isCommentEnabled() && $modCommentsModel->isPermitted('DetailView')) {
			$relatedLinks[] = array(
					'linktype' => 'DETAILVIEWTAB',
					'linklabel' => 'ModComments',
					'linkurl' => $recordModel->getDetailViewUrl().'&mode=showAllComments',
					'linkicon' => ''
			);
		}

		if($parentModuleModel->isTrackingEnabled()) {
			$relatedLinks[] = array(
					'linktype' => 'DETAILVIEWTAB',
					'linklabel' => 'LBL_UPDATES',
					'linkurl' => $recordModel->getDetailViewUrl().'&mode=showRecentActivities&page=1',
					'linkicon' => ''
			);
		}


		$relationModels = $parentModuleModel->getRelations();

		foreach($relationModels as $relation) {
			//TODO : Way to get limited information than getting all the information
			$link = array(
					'linktype' => 'DETAILVIEWRELATED',
					'linklabel' => $relation->get('label'),
					'linkurl' => $relation->getListUrl($recordModel),
					'linkicon' => '',
					'relatedModuleName' => $relation->get('relatedModuleName') 
			);
			$relatedLinks[] = $link;
		}

		return $relatedLinks;
	}

	
}
