import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:mobileapplication/components/rounded_button.dart';
import 'package:mobileapplication/screens/entercode/blocs/entercode/entercode_bloc.dart';
import 'package:mobileapplication/screens/entercode/blocs/entercode/entercode_state.dart';
import 'package:mobileapplication/screens/entercode/components/entercode_container.dart';
import 'package:mobileapplication/screens/roomques/roomques_screen.dart';

class EnterCodeScreen extends StatefulWidget {
  @override
  State<StatefulWidget> createState() => _EnterCodeScreenState();
}

class _EnterCodeScreenState extends State<EnterCodeScreen> {
  @override
  void initState() {
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      resizeToAvoidBottomInset: false,
      appBar: AppBar(
        title: Text('Enter Code Sreen'),
      ),
      body: BlocConsumer<EnterCodeBloc, EnterCodeState>(
        listener: (context, state) {
          if (state is EnterCodeStateSuccess) {
            if (state.checkIdRoomResponse.isgo) {
              Navigator.pushReplacement(
                context,
                MaterialPageRoute(builder: (context) {
                  return RoomQuesScreen();
                }),
              );
            }
          }
        },
        builder: (context, state) {
          return Container(
            child: Column(children: <Widget>[
              EnterCodeContainer(),
            ]),
          );
        },
      ),
    );
  }
}
