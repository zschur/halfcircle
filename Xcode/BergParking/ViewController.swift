//
//  ViewController.swift
//  BergParking
//
//  Created by Zachary Norman Schur on 9/23/19.
//  Copyright © 2019 Zachary Schur. All rights reserved.
//

import UIKit

class ViewController: UIViewController {

    override func viewDidLoad() {
        
        //load main view
        super.viewDidLoad()
        
        //set background image to full screen and repeat if necessary
        let backgroundImage = UIImageView(frame: UIScreen.main.bounds)
        backgroundImage.image = UIImage(named: "bg")
        backgroundImage.contentMode = UIView.ContentMode.scaleAspectFill
        self.view.insertSubview(backgroundImage, at: 0)
        
        
    }


}

